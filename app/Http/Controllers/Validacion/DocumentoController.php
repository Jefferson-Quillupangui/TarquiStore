<?php

namespace App\Http\Controllers\Validacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tavo\ValidadorEc;

class DocumentoController extends Controller
{
     
    
    public function validarIdentificacion(Request $request){

        
        $identificacion = $request->identificacion ;
        $tipoDocumt = $request->tipoDocumt ;

     
    
        if( $tipoDocumt == "05"){
           $rpt = $this->cedula($identificacion);
           return $rpt;
        }else if($tipoDocumt == "06"){
            $rpt = $this->Ruc($identificacion);
            return $rpt;
        }
        
        
         
    }

    public function cedula($identificacion){

        $validador = new ValidadorEc();
        
        if ($validador->validarCedula($identificacion)) {
            //echo 'Cédula válida';
           // $out_id_order = $id_cab_pedido;
            $out_cod = 7; 
            $out_msj = 'Cédula válida.';
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
            //return $msj = $this->msj_estado_orden($out_id_order, $out_cod, $out_msj);
        } else {
            //echo 'Cédula incorrecta: '.$validador->getError();
            $out_cod = 6; 
            $out_msj = 'Cédula incorrecta: '.$validador->getError();
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
            
        }
        
    }


    public function Ruc($identificacion){

        $validador = new ValidadorEc();
        
        // validar RUC persona natural
        if ($validador->validarRucPersonaNatural($identificacion)) {
            $out_cod = 7; 
            $out_msj = 'RUC válido Pesona Natural';
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
        } 
        // validar RUC sociedad privada
        else if ($validador->validarRucSociedadPrivada($identificacion)) {
            $out_cod = 7; 
            $out_msj = 'RUC válido Sociedad Privada';
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
        }
        // validar RUC sociedad pública
        else if ($validador->validarRucSociedadPublica($identificacion)) {
            $out_cod = 7; 
            $out_msj = 'RUC válido Sociedad Publica';
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
        } else {
            $out_cod = 6; 
            $out_msj = 'RUC incorrecto: '.$validador->getError();
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
        }
        
    }
}