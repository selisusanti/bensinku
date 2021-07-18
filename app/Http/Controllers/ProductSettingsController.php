<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductSettingsController extends Controller
{
    public function index(){
        return view('product-settings.main');
    }


    public function getData(Request $request)
    {
        $columns = array( 
            0 =>'promo_name', 
            1 =>'minimum_pembelian',
            2=> 'expired',
            3=> 'status',
            4=> 'Keperluan',
            5=> 'Keterangan',
            6=> 'ValidDate',
        );

        $namaOrder      = $columns[$request->input('order.0.column')];
        $ordering       = $request->input('order.0.dir');
        $limit          = $request->input('length');
        $start          = $request->input('start');
        $search         = $_POST['search'];
        $filter         = $_POST['filter'];


        $datanya            = DetailPengajuan::with('masterPengajuan')   
                            ->orderBy('ValidDate',$ordering)                 
                            ->offset($start)
                            ->limit($limit);

        if(!empty($search)){
            if($filter == 'NamaCustomer'){
                $datanya    = $datanya->WhereHas('masterPengajuan', function($q) use ($search) {
                                    $q->where( 'NamaLengkap', "like", "%".$search."%");
                                });
            }elseif($filter == 'Nama'){
                $datanya = $datanya->where("nama","like","%".$search."%");
            }elseif($filter == 'NoPaspor'){
                $datanya = $datanya->where("NoPassport","like","%".$search."%");
            }
        }

        $datanya        = $datanya->get()->toJson();

        $total            = DetailPengajuan::with('masterPengajuan')   
                                ->orderBy('ValidDate','asc');

        if(!empty($search)){
            if($filter == 'NamaCustomer'){
                $total    = $total->WhereHas("masterPengajuan", function($q) use ($search) {
                                    $q->where("NamaLengkap", "like", "%".$search."%");
                                });
            }elseif($filter == 'Nama'){
                $total = $total->where("nama","like","%".$search."%");
            }elseif($filter == 'NoPaspor'){
                $total = $total->where("NoPassport","like","%".$search."%");
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
                $nestedData['Product Name']         = $value->master_pengajuan->NamaLengkap;
                $nestedData['Brand']                = $value->nama;
                $nestedData['Harga Per Liter']      = $value->AsalNegara;
                $nestedData['Last Update']          = $value->NoPassport;
                $nestedData['Status']               = date('d-m-Y',strtotime($value->ValidDate));
                $nestedData['Action']               = '<a href="/manage-paspor/edit-manage-paspor/'.$value->id.'">
                                                        <button type="button" class="btn btn-sm btn link-button" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil-alt" style="color:#1b3759;"></i> 
                                                        </button>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        data-href="/manage-paspor/delete-paspor/'.$value->id.'"
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

}
