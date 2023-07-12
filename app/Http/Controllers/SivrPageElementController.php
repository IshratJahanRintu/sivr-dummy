<?php

namespace App\Http\Controllers;

use App\Models\SivrPageElement;
use Illuminate\Http\Request;

class SivrPageElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        SivrPageElement::query()->create([

            'page_id' => $request->page_id,
            'type ' => $request->type,
            'display_name_bn' => $request->display_name_bn,
            'display_name_en' => $request->display_name_en,
            'background_color' => $request->background_color,
            'text_color' => $request->text_color,
            'name' => $request->name,
            'value' => $request->value,
            'element_order' => $request->element_order,
            'rows' => $request->rows,
            'is_visible' => $request->is_visible,
            'data_provider_function' => $request->data_provider_function,


        ]);
        return redirect(route('sivr-pages.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request, SivrPageElement $sivrPageElement)
    {

        $updated = $sivrPageElement->update([

            'type ' => $request->type,
            'display_name_bn' => $request->display_name_bn,
            'display_name_en' => $request->display_name_en,
            'background_color' => $request->background_color,
            'text_color' => $request->text_color,
            'name' => $request->name,
            'value' => $request->value,
            'element_order' => $request->element_order,
            'rows' => $request->rows,
            'is_visible' => $request->is_visible,
            'data_provider_function' => $request->data_provider_function,


        ]);
        if ($updated) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(SivrPageElement $sivrPageElement)
    {
        $sivrPageElement->forceDelete();
        return redirect(route('sivr-pages.index'));
    }
}
