<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\logic\Msg_logic;
use App\logic\Service_logic;
use Illuminate\Support\Facades\Session;

class MsgController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // get now page

        // Service_logic::get_service_id_by_url_and_save( $request->path() );

        // search bar setting

        // $search_tool = array(5,6);

        // Redis_tool::set_search_tool( $search_tool );

        $msg = Msg_logic::get_msg_list( $_GET );
 
        $htmlData = Msg_logic::msg_list_data_bind( $msg );

        $htmlJsonData = json_encode($htmlData);

        $assign_page = "msg/msg_list";

        $data = compact('assign_page', 'msg', 'htmlJsonData');

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

        $htmlData = Msg_logic::get_msg_input_template_array();

        $htmlData = Msg_logic::msg_input_data_bind( $htmlData, $OriData );

        $htmlData["action"] = "/msg";

        $htmlData["method"] = "post"; 
  
        $htmlJsonData = json_encode($htmlData);

        $assign_page = "msg/msg_input";

        $data = compact('assign_page', 'htmlJsonData');

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

        if ( isset($_POST["subject"]) ) 
        {

            $data = Msg_logic::insert_format( $_POST );

            Msg_logic::add_msg( $data );

        }
        
        return redirect("/msg");

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

        $msg = Msg_logic::get_single_msg( (int)$id ); 

        $htmlData = Msg_logic::get_msg_input_template_array();

        $msg = get_object_vars($msg);
  
        $htmlData = Msg_logic::msg_input_data_bind( $htmlData, $msg );

        $htmlData["action"] = "/msg/" . (int)$id;

        $htmlData["method"] = "patch";

        $htmlJsonData = json_encode($htmlData);

        $assign_page = "msg/msg_input";

        $data = compact('assign_page', 'htmlJsonData');

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

        $_POST["msg_id"] = $id;
            
        $data = Msg_logic::update_format( $_POST );

        $msg_id = intval($_POST["msg_id"]);

        Msg_logic::edit_msg( $data, $msg_id );

        return redirect("/msg");

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


    public function clone()
    {

        $msg_id = isset($_GET["msg_id"]) ? intval($_GET["msg_id"]) : 0 ;
    
        $msg = Msg_logic::get_single_msg( $msg_id ); 

        $msg = Msg_logic::clone_msg( $msg ); 

 		Msg_logic::add_msg( $msg );

 		return redirect("/msg");

    }

}
