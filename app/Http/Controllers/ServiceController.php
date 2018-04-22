<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\logic\Role_logic;
use App\logic\Service_logic;
use App\logic\Redis_tool;
use App\logic\Web_cht;
use App\logic\Basetool;
use Illuminate\Support\Facades\Session;

class ServiceController extends Basetool
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

        $search_tool = array(4,5,7);

        $search_query = $_this->get_search_query( $search_tool, $_GET );


        $service_data = Service_logic::get_service_data();

        $service_list = Service_logic::get_service_list( $_GET );


        $role_service = Role_logic::get_role_service();

        $service = Service_logic::get_parents_name( $service_list, $service_data );

        $service = Service_logic::get_service_role_auth( $service, $role_service );


        $htmlData = Service_logic::service_list_data_bind( $service );

        $htmlJsonData = json_encode($htmlData);


        $assign_page = "service/service_list";

        $data = compact('service', 'search_tool', 'assign_page', 'htmlJsonData');

        return view('webbase/content', $data);        
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $service = "";
 
        $assign_page = "service/service_input";

        $OriData = Session::get( 'OriData' );

        Session::forget( 'OriData' );

        $htmlData = Service_logic::get_service_input_template_array();

        $htmlData = Service_logic::service_input_data_bind( $htmlData, $OriData );

        $htmlData["action"] = "/service";

        $htmlData["method"] = "post"; 
  
        $htmlJsonData = json_encode($htmlData);


        $data = compact('service', 'assign_page', 'htmlJsonData');

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

        // service

        $data = Service_logic::insert_format( $_POST );
     
        $service_id = Service_logic::add_service( $data );

        // user role add

        if (!empty($_POST["auth"])) 
        {
            $data = Role_logic::add_role_service_format( 0, $service_id, $_POST["auth"] );

            Role_logic::add_role_service( $data );
        }

        Redis_tool::del_menu_data_all();

        $page_query = $_this->made_search_query();

        return redirect("/service".$page_query);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $service = Service_logic::get_service( (int)$id );
 
        $assign_page = "service/service_input";

        $service = get_object_vars($service);

        $htmlData = Service_logic::get_service_input_template_array();

        $htmlData = Service_logic::service_input_data_bind( $htmlData, $service );

        $htmlData["action"] = "/service/" . (int)$id;

        $htmlData["method"] = "patch";

        $htmlJsonData = json_encode($htmlData);

        $data = compact('service', 'assign_page', 'htmlJsonData');

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
 
        // service

        $_POST["service_id"] = intval($id);

        $data = Service_logic::update_format( $_POST );

        $service_id = $_POST["service_id"];

        Service_logic::edit_service( $data, $service_id );

        // service role delete add

        Role_logic::delete_role_service( 0, $service_id );
        
        if (!empty($_POST["auth"])) 
        {
            $data = Role_logic::add_role_service_format( 0, $service_id, $_POST["auth"] );

            Role_logic::add_role_service( $data );
        }

        Redis_tool::del_menu_data_all();

        $page_query = $_this->made_search_query();

        return redirect("/service".$page_query);

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
     * Service Public
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function service_public()
    {

        $txt = Web_cht::get_txt();

        $service = Service_logic::get_unpublic_service_data();

        $assign_page = "service/service_public";

        $public_txt = array(
                            1 => $txt["already_public"],
                            2 => $txt["not_public"],
                            3 => $txt["forbid_public"],
                            4 => $txt["free_public"]
                        );

        $data = compact('assign_page', 'service', 'public_txt');

        return view('webbase/content', $data);

    }

    /**
     * Service Public Process
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function service_public_process()
    {

        if ( !empty($_GET) ) 
        {

            $service = Service_logic::public_service( $_GET );

        }

        return redirect("/service_public");

    }


}
