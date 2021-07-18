<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class PromoController extends Controller
{
    public function index(){
        return view('promo.main');
    }


    public function getData(Request $request)
    {
        $columns = array( 
            0 =>'promo_name', 
            1 =>'minimum_pembelian',
            2=> 'expired',
            3=> 'status',
        );

        $namaOrder      = $columns[$request->input('order.0.column')];
        $ordering       = $request->input('order.0.dir');
        $limit          = $request->input('length');
        $start          = $request->input('start');
        $search         = $_POST['search'];
        $filter         = $_POST['filter'];


        $datanya            = Promo::orderBy($namaOrder,$ordering)                 
                            ->offset($start)
                            ->limit($limit);

        if(!empty($search)){
            if($filter == 'PromoName'){
                $datanya = $datanya->where("promo_name","like","%".$search."%");
            }elseif($filter == 'Minimum'){
                $datanya = $datanya->where("minimum_pembelian","like","%".$search."%");
            }elseif($filter == 'Status'){
                if($search == 'OPEN'){
                    $status = 1;
                }else{
                    $status = 0;
                }
                $datanya = $datanya->where("status","=",$status);
            }
        }

        $datanya          = $datanya->get()->toJson();

        $total            = Promo::orderBy('created_at','asc');

        if(!empty($search)){
            if($filter == 'PromoName'){
                $total = $total->where("promo_name","like","%".$search."%");
            }elseif($filter == 'Minimum'){
                $total = $total->where("minimum_pembelian","like","%".$search."%");
            }elseif($filter == 'Status'){
                if($search == 'open' || $search == 'OPEN'){
                    $status = 1;
                }else{
                    $status = 0;
                }
                $total = $total->where("status","=",$status);
            }
        }

        $total3         = $total->paginate(10)->toJson();


        $total2         = json_decode($total3);
        $dataOutput     = json_decode($datanya);

        $totalData      = $total2->total;
        $totalFiltered  = $totalData;
        $data           = array();
        if($totalData > 0)
        {
            foreach ($dataOutput as $key => $value)
            {
                $nestedData['Promo Name']           = $value->promo_name;
                $nestedData['Minimum Pembelian']    = $value->minimum_pembelian;
                $nestedData['Berakhir']             = date('d-m-Y',strtotime($value->expired));
                $nestedData['Status']               = ($value->status == '1') ? "OPEN" : 'CLOSED';
                $nestedData['Action']               = '<a href="/promo/edit-promo/'.$value->id.'">
                                                        <button type="button" class="btn btn-sm btn link-button" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil-alt" style="color:#1b3759;"></i> 
                                                        </button>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        data-href="/promo/delete-promo/'.$value->id.'"
                                                        data-good="" 
                                                        data-toggle="modal" 
                                                        data-target="#delete-user">
                                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="fa fa-trash-alt" style="color:red;"></i> 
                                                        </button>
                                                    </a>';
                $data[] = $nestedData;
            }
        }
    
        $json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );
    
        return $json_data;

    }

    public function formAddPromo(){
        return view('promo.add-promo');
    }

    public function savePromo(Request $request){
        try {

            DB::beginTransaction();
            $save = Promo::create([
                'promo_name'            => $request->promo_name,
                'company_vendor'        => $request->company_vendor,
                'code'                  => $request->code,
                'qty'                   => $request->qty,
                'percentage'            => $request->percentage,
                'expired'               => date('Y-m-d',strtotime($request->expired)),
                'description'           => $request->description,
                'status'                => $request->status,
                'minimum_pembelian'     => $request->minimum_pembelian,
            ]);


            DB::commit();
            Session::flash('success', "Insert Sukses!");
            return redirect('promo');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('error', "Insert Gagal!");
            return redirect('promo/add-promo')->withInput();
        }
    }

    public function formEditPromo($id){
        $dataOutput = Promo::where('id', $id)
                    ->first();

        return view('promo.edit-promo')
                ->with('value', $dataOutput);
    }

    public function editPromo(Request $request){
        try {

            DB::beginTransaction();
            $response                   = Promo::find($request->id);
            $response->update([
                'promo_name'            => $request->promo_name,
                'company_vendor'        => $request->company_vendor,
                'code'                  => $request->code,
                'qty'                   => $request->qty,
                'percentage'            => $request->percentage,
                'expired'               => date('Y-m-d',strtotime($request->expired)),
                'description'           => $request->description,
                'status'                => $request->status,
                'minimum_pembelian'     => $request->minimum_pembelian,
            ]);


            DB::commit();
            Session::flash('success', "Update Sukses!");
            return redirect('promo');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('error', "Update Gagal!");
            return redirect('promo/add-promo')->withInput();
        }
    }


    public function deletePromo($id){
        try {

            DB::beginTransaction();
            $response                   = Promo::find($id);
            $response->update([
                'is_delete'     => '1',
            ]);
            $response->delete();

            DB::commit();
            Session::flash('success', 'Delete Sukses');
            return redirect('promo');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('error', 'Delete Gagal');
            return redirect('promo');
        }

    }


}
