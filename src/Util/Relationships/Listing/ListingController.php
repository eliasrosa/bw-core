<?php

namespace BW\Util\Relationships\Listing;

use Illuminate\Http\Request;
use BW\Util\Validation\Validator;
use BW\Controllers\BaseController;
use BW\Util\Relationships\Listing\ListingForm;
use BW\Util\Relationships\Listing\Models\Listing;

class ListingController extends BaseController
{
    //
    public function __construct()
    {
        $this->middleware('BW\Util\Relationships\Listing\ListingMiddleware');
    }

    //
    public function index()
    {
        $relation = $this->getRelation();
        $breadcrumb = $this->createBreadcrumb();

        //
        $lists = Listing::where('relation_id', $relation['id'])->get();
        $relations_menu = \BWAdmin::createRelationshipsMenu(Listing::class, $relation['id']);

        //
        return view('BW::util.relationships.listing.index')
            ->with(compact('lists', 'relation', 'relations_menu', 'breadcrumb'));
    }

    //
    public function create()
    {
        //
        $breadcrumb = $this->createBreadcrumb('Novo');
        $relation = $this->getRelation();
        $form = new ListingForm();

        //
        return $this->view('BW::util.relationships.listing.create')
            ->with(compact('form', 'relation', 'breadcrumb'));
    }

    //
    public function store(Request $request)
    {
        //
        $relation = $this->getRelation();

        //
        $validator = Validator::make(Listing::class, ListingForm::class, $request->all(), [
            'name' => 'required',
        ], [], [], $relation['id']);

        //
        if($validator->fails()) {
            $this->flash()->error('Ops! Alguns campos não foram preenchidos corretamente');
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //
        $i = new Listing();
        $i->name = $request->get('name');
        $i->position = (int) $request->get('position');
        $i->description = $request->get('description');
        $i->relation_id = $relation['id'];
        $i->save();

        //
        $i->saveRelationships();

        // redirect
        return $this->redirectToIndex('Item da lista adicionado com sucesso!');
    }

    //
    public function edit($id)
    {
        //
        $breadcrumb = $this->createBreadcrumb('Editando');
        $relation = $this->getRelation();
        $form = new ListingForm($id);

        //
        return $this->view('BW::util.relationships.listing.edit')
            ->with(compact('form', 'relation', 'breadcrumb'));
    }

    //
    public function update(Request $request)
    {
        //
        $relation = $this->getRelation();

        //
        $validator = Validator::make(Listing::class, ListingForm::class, $request->all(), [
            'name' => 'required',
        ], [], [], $relation['id']);

        //
        if($validator->fails()) {
            $this->flash()->error('Ops! Alguns campos não foram preenchidos corretamente');
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //
        $i = Listing::find($request->get('id'));
        $i->name = $request->get('name');
        $i->position = (int) $request->get('position');
        $i->description = $request->get('description');
        $i->save();

        //
        $i->saveRelationships();

        // redirect
        return $this->redirectToIndex('Item da lista atualizado com sucesso!');
    }

    //
    public function destroy($id)
    {
        //
        $list = Listing::find($id);

        //
        if($list->ref->count()){
            $this->flash()->error('Você não pode remover este item, pois existem um ou mais registros relacionados a ele!');
            return back();
        }

        // delete
        $list->deleteRelationships();
        $list->delete();

        // redirect
        return $this->redirectToIndex('Item removido com sucesso!');

    }

    private function redirectToIndex($msg)
    {
        //
        $relation = $this->getRelation();

        //
        $this->flash()->success($msg);
        return redirect()->route('bw.relationships.listing.index', [
            'relation_id' => $relation['id']
        ]);
    }

    //
    private function getRelation()
    {
        return \BWAdmin::get('relationships')->get()
            ->where('id', request('relation_id'))
            ->first();
    }

    //
    private function createBreadcrumb($title = null)
    {
        $breadcrumb = [];
        $relation = $this->getRelation();

        while(!is_null($relation['parent'])){

            $breadcrumb[] = [
                'title' => $relation['title'],
                'href'  => route('bw.relationships.listing.index', [
                    'relation_id' => $relation['id']
                ])
            ];

            $relation = \BWAdmin::get('relationships')->get()
                ->where('id', $relation['parent'])
                ->first();
        }

        //
        $breadcrumb[] = [
            'title' => $relation['title'],
            'href'  => route('bw.relationships.listing.index', [
                'relation_id' => $relation['id']
            ])
        ];

        //
        $model = \BWAdmin::get('relationships')
            ->getModel($relation['model']);

        $breadcrumb[] = [
            'title' =>  $model['title'],
            'href'  => route($model['route-index'])
        ];

        //
        $breadcrumb = array_reverse($breadcrumb);

        //
        if(!is_null($title)){
            $breadcrumb[] = [
                'title' =>  $title,
                'href'  => false
            ];
        }else{
            $breadcrumb[count($breadcrumb)-1]['href'] = false;
        }

        //
        return $breadcrumb;
    }
}
