<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\logic\Role_logic;
use App\logic\Service_logic;
use App\logic\Redis_tool;
use App\logic\Basetool;
use App\logic\Web_cht;
use Illuminate\Support\Facades\Session;

class RoleController extends Basetool
{

    public function __construct()
    {

        // 文字

        $txt = Web_cht::get_txt();

        $this->status = array(
                            1   =>  $txt["enable"],
                            2   =>  $txt["disable"]
                        );

    }   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $_this = new self();

        $search_tool = array(5,6);

        $search_query = $_this->get_search_query( $search_tool, $_GET );

        $role = Role_logic::get_role_list( $_GET );

        $htmlData = Role_logic::role_list_data_bind( $role );

        $htmlJsonData = json_encode($htmlData);
 
        $assign_page = "role/role_list";

        $data = compact('role', 'search_tool', 'assign_page', 'htmlJsonData');

        return view('webbase/content', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $OriData = Session::get( 'OriData' );

        Session::forget( 'OriData' );

        $htmlData = Role_logic::get_role_input_template_array();

        $htmlData = Role_logic::role_input_data_bind( $htmlData, $OriData );

        $htmlData["action"] = "/role";

        $htmlData["method"] = "post"; 
  
        $htmlJsonData = json_encode($htmlData);

        $assign_page = "role/role_input";

        $data = compact('role', 'assign_page', 'htmlJsonData');

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

        if ( isset($_POST["name"]) ) 
        {

            // role

            $data = Role_logic::insert_format( $_POST );
         
            $role_id = Role_logic::add_role( $data );

            // role service add
            
            if (!empty($_POST["auth"])) 
            {

                $data = Role_logic::add_role_service_format( $role_id, 0, $_POST["auth"] );

                $data = Role_logic::add_role_service( $data );
            
            }

        }

        $page_query = $_this->made_search_query();

        return redirect("/role".$page_query);

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

        $role = Role_logic::get_role( (int)$id );


        $htmlData = Role_logic::get_role_input_template_array();

        $role = get_object_vars($role);
  
        $htmlData = Role_logic::role_input_data_bind( $htmlData, $role );

        $htmlData["action"] = "/role/" . (int)$id;

        $htmlData["method"] = "patch";

        $htmlJsonData = json_encode($htmlData);


        $assign_page = "role/role_input";

        // $menu_data = Service_logic::get_active_service();

        // $menu_list = Service_logic::menu_format( $menu_data );

        $role_service_data = Role_logic::get_role_service( $id );

        $role_service = Service_logic::role_auth_format( $role_service_data );

        $data = compact('role', 'assign_page', 'role_service', 'htmlJsonData');

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

        // role

        $_POST["role_id"] = intval( $id );

        $data = Role_logic::update_format( $_POST );

        $role_id = $_POST["role_id"];

        Role_logic::edit_role( $data, $role_id );

        // role service delete add

        Role_logic::delete_role_service( $role_id ) ;

        if (!empty($_POST["auth"])) 
        {

            $data = Role_logic::add_role_service_format( $role_id, 0, $_POST["auth"] );

            Role_logic::add_role_service( $data );

        }

        $page_query = $_this->made_search_query();

        return redirect("/role".$page_query);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        //
    }
}
