<?php

namespace Api\V1;

use Laragento;
use \Input;
use \Config;
use \Response;

class WineClubController extends \BaseController {

    protected $apiVersion = 'v1';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $limit = Input::has('limit') ? Input::get('limit') : Config::get('app.laragento.defaults.pagination.limit');
        $offset = Input::has('offset') ? Input::get('offset') : Config::get('app.laragento.defaults.pagination.offset');

        if(Input::has('customer'))
        {
            /** @var Laragento\Customer $customer */
            $customer = Laragento\Customer::findOrFail(Input::get('customer'));

            $wineClubs = $customer->wineClubs;

        }

        else
        {
            //todo: generic
            $resourceQuery = Laragento\WineClub::take($limit)->skip($offset);

            $select = array('*');

            $resourceQuery->select($select);

            $wineClubs = $resourceQuery->get();

        }


        $outputWineClubs = array();

        foreach($wineClubs as $wineClub){

            $outputWineClubs[] = $wineClub->prepareOutput($this->apiVersion);
        }

        return Response::json($outputWineClubs);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $wineClub = new Laragento\WineClub($id);

        return($wineClub->prepareOutput($this->apiVersion));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}