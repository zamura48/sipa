<?php

namespace App\Http\Controllers;

use App\Models\Pilihan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class PilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Master Opsi';

        if ($request->ajax()) {
            $data = Pilihan::all();

            return DataTables::of($data)
                ->addColumn('aksi', function ($model) {
                    return '<button class="btn btn-warning btn-sm btn-edit" data-id="' . $model->id . '"><i class="fa fa-edit mr-1"></i> Edit</button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $model->id . '"><i class="fa fa-trash mr-1"></i> Delete</button>';
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        return view('admin.pilihan.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function validation($request)
    {
        $validator = Validator::make($request->all(), [
            'parameter' => 'required',
            'nama' => 'required',
            'isi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $this->validation($request);
        if ($validate) {
            return $validate;
        }

        Pilihan::create($request->all());

        return response()->json(['status' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pilihan $pilihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($pilihan)
    {
        $data_ = Pilihan::findOrFail($pilihan);
        return response()->json($data_);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $pilihan)
    {
        $validate = $this->validation($request);
        if ($validate) {
            return $validate;
        }

        $data_ = Pilihan::findOrFail($pilihan);
        $data_->update($request->all());

        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($pilihan)
    {
        $data_ = Pilihan::findOrFail($pilihan);
        $data_->delete();

        return response()->json(['status' => true], 200);
    }
}
