<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\logic\Admin_user_logic;
use App\logic\Role_logic;
use App\logic\Service_logic;
use App\logic\Web_cht;
use App\logic\Basetool;
use App\logic\Redis_tool;
use Illuminate\Support\Facades\Session;
use App\logic\Register;
use Illuminate\Support\Facades\Storage;

class UserController extends Basetool
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $_this = new self();


        // search bar setting

        $search_tool = array(2,3,5);

        $search_query = $_this->get_search_query( $search_tool, $_GET );

        $user = Admin_user_logic::get_user_list( $data = $_GET );

        $htmlData = Admin_user_logic::user_list_data_bind( $user );

        $htmlJsonData = json_encode($htmlData);


        $assign_page = "admin_user/admin_list";

        $data = compact('user', 'search_tool', 'assign_page', 'service_id', 'htmlJsonData');

        return view('webbase/content', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $_this = new self();


        $OriData = Session::get( 'OriData' );

        Session::forget( 'OriData' );

        $htmlData = Admin_user_logic::get_admin_input_template_array();

        $htmlData = Admin_user_logic::admin_input_data_bind( $htmlData, $OriData );

        $htmlData["action"] = "/user";

        $htmlData["method"] = "post"; 
  
        $htmlJsonData = json_encode($htmlData);


        $assign_page = "admin_user/admin_input";

        $data = compact('role_list', 'assign_page', 'account_status', 'htmlJsonData');

        return view('webbase/content', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $_this = new self();

        $txt = Web_cht::get_txt();

        // parents_id

        $Login_user = Session::get('Login_user');

        $_POST["parents_id"] = isset($Login_user["user_id"]) ? $Login_user["user_id"] : 0 ;
        
        $_POST["social_register"] = 0;

        try
        {

            // verify process

            $ErrorMsg = Admin_user_logic::account_verify( $_POST );

            if (!empty($ErrorMsg)) 
            {

                throw new \Exception( json_encode($ErrorMsg) );

            }

            // user

            $data = Admin_user_logic::insert_format( $_POST );

            $user_id = Admin_user_logic::add_user( $data );

            // user role add

            $data = Admin_user_logic::add_user_role_format( $user_id, $_POST["auth"] );

            Admin_user_logic::add_user_role( $data );

            $date_spec = isset($_POST["date_spec"]) && !empty($_POST["date_spec"]) ? trim($_POST["date_spec"]) : "" ;

            // 紀錄價值服務啟用列表，免費不紀錄

            if ( !empty($date_spec) ) 
            {

                Shop_logic::add_use_record( (int)$user_id, $date_spec, $type = 1 );

            }

        }
        catch(\Exception $e)
        {

            Session::put( 'OriData', $_POST );

            Session::put( 'ErrorMsg', $_this->show_error_to_user( json_decode($e->getMessage() ,true) ) );

            return back();

        }

        $page_query = $_this->made_search_query();

        return redirect("/user".$page_query);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {

        $_this = new self;

        $account_status = "";

        $user = Admin_user_logic::get_user( (int)$id );

        // $user_role = $id > 0 ? Admin_user_logic::get_user_role_by_id( (int)$id ) : "" ;

        // $user_role = $_this->get_object_or_array_key( $user_role );

        // $role_list = Role_logic::get_active_role();

        // $role_list = Role_logic::filter_admin_role($role_list);

        $htmlData = Admin_user_logic::get_admin_input_template_array();

        $user = get_object_vars($user);
  
        $htmlData = Admin_user_logic::admin_input_data_bind( $htmlData, $user );

        $htmlData["action"] = "/user/" . (int)$id;

        $htmlData["method"] = "patch";

        $htmlJsonData = json_encode($htmlData);


        $assign_page = "admin_user/admin_input";

        $data = compact('assign_page', 'account_status', 'htmlJsonData');

        return view('webbase/content', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $_this = new self();

        $txt = Web_cht::get_txt();
            
        try
        {

            $ErrorMsg = Admin_user_logic::account_verify( $_POST );

            if (!empty($ErrorMsg)) 
            {

                throw new \Exception( json_encode($ErrorMsg) );

            }

            // user

            $data = Admin_user_logic::update_format( $_POST );

            $user_id = intval($id);

            Admin_user_logic::edit_user( $data, $user_id );

            // user role delete add

            Admin_user_logic::delete_user_role( $user_id );

            Redis_tool::del_user_role( $user_id );

            $data = Admin_user_logic::add_user_role_format( $user_id, $_POST["auth"] );

            Admin_user_logic::add_user_role( $data );


        }
        catch(\Exception $e)
        {

            Session::put( 'ErrorMsg', $_this->show_error_to_user( json_decode($e->getMessage() ,true) ) );

            return back();

        }


        $page_query = $_this->made_search_query();

        return redirect("/user".$page_query);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * photo_index
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photo_index()
    {

        $data = Admin_user_logic::get_user_photo();
 
        $assign_page = "admin_user/photo_index";

        $data = compact('user', 'data', 'assign_page');

        return view('webbase/content', $data);

    }

    /**
     * photo_upload_process
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photo_upload_process(Request $request)
    {

        // 預覽用

        if ($request->hasFile('photo_upload_preview')) 
        {
            
            Storage::makeDirectory("photo_upload_preview");

            $photo_upload_files = $request->file('photo_upload_preview')->store('photo_upload_preview');

            echo json_encode($photo_upload_files);

            exit();
        
        }

        // 存圖

        if ($request->hasFile('photo_upload')) 
        {
            
            Storage::makeDirectory("photo_upload");

            $photo_upload_files = $request->file('photo_upload')->store('photo_upload');

            Admin_user_logic::edit_user_photo( $photo_upload_files );

            echo json_encode($photo_upload_files);

            exit();
        
        }

    }


}
