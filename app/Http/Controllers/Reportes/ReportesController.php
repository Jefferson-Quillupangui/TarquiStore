<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use JasperPHP;
use JasperPHP\JasperPHP;
use PHPJasper\PHPJasper; 

class ReportesController extends Controller
{


    
    

    public function post()
    {
        $database = \Config::get('database.connections.mysql');

        $output = public_path() . '/report/'.time().'_codelution';

        $ext = "pdf";

        \JasperPHP::process(
            public_path() . '/report/OrdenesCabecera.jasper',
            $output,
            array($ext),
            array(),
            $database,
            false,
            false
        )->execute();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.time().'_codelution.'.$ext);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($output.'.'.$ext));
        flush();
        readfile($output.'.'.$ext);
        unlink($output.'.'.$ext); // deletes the temporary file

        return Redirect::to('/reportNuevo');


        
    }


    
    /**
     * Reporna um array com os parametros de conexão
     * @return Array
     */
        public function getDatabaseConfig()
        {
           
            //          'host'     => '127.0.0.1',//env('DB_HOST'),
            //          'port'     => '3306',//env('DB_PORT'),
            //          'username' => 'root',//env('DB_USERNAME'),
            //          'password' => '',//env('DB_PASSWORD'),
            //          'database' => 'tarquistore',//env('DB_DATABASE'),
            //          'jdbc_driver' => 'com.mysql.jdbc.Driver',
            return [
                'driver'   => env('com.mysql.jdbc.Driver'),
            'host'     => env('127.0.0.1'),
            'port'     => env('80'),
            'username' => env('root'),
            'password' => env(''),
            'database' => env('tarquistore'),
                'jdbc_dir' => base_path() . env('JDBC_DIR', '/vendor/lavela/phpjasper/src/JasperStarter/jdbc'),
            ];
        }
        public function index()
        {
        // coloca na variavel o caminho do novo relatório que será gerado
            $output = public_path() . '/reports/' . time() . '____OrdenesCabecera';
        // instancia um novo objeto JasperPHP
            
            $report = new JasperPHP;
        // chama o método que irá gerar o relatório
            // passamos por parametro:
            // o arquivo do relatório com seu caminho completo
            // o nome do arquivo que será gerado
            // o tipo de saída
            // parametros ( nesse caso não tem nenhum)         
            $report->process(
                public_path() . '/reports/OrdenesCabecera.jrxml',
                $output,
                ['pdf'],
                [],
                $this->getDatabaseConfig()
            )->output();
            
            //execute    output
            $file = $output . '.pdf';
            $path = $file;
            
            //dd($path);
            // caso o arquivo não tenha sido gerado retorno um erro 404
            if (!file_exists($file)) {
                abort(404);
            }
        //caso tenha sido gerado pego o conteudo
            $file = file_get_contents($file);
        //deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
            unlink($path);
        //retornamos o conteudo para o navegador que íra abrir o PDF
            return response($file, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="cliente.pdf"');
        
        }



        public function reporteHola(){
            $input = base_path() .
            '/public/reports/blanco.jrxml';
            //'/vendor/geekcom/phpjasper/examples/blanco.jrxml';
            //dd( $input);
            $jasper = new PHPJasper;
            $jasper->compile($input)->execute();

            return response()->json([
                'status' => 'ok',
                'msj' => '¡Reporte compilado..!'
            ]);
        }

        public function reporteHolaCompilarPhp(){
            $input = base_path() .
            '/public/reports/blanco.jasper';
            //'/vendor/geekcom/phpjasper/examples/blanco.jasper';
            $output = base_path() .
            '/public/reports';
            //'/vendor/geekcom/phpjasper/examples';
            $options = [
                'format' => ['pdf']
            ];
        
            $jasper = new PHPJasper;
        
            $jasper->process(
                $input,
                $output,
                $options
            )->execute();
        
            $pathToFile = base_path() .
            '/public/reports/blanco.pdf';
            return response()->file($pathToFile);
        }






        
//     public function getDatabaseConfig()
//     {
//         //'C:\xampp\htdocs\JasperReport\vendor\cossou\jasperphp\src\JasperStarter\jdbc'
        
//       $jdbc_dir = 'C:\laragon\www\TarquiStore\vendor\cossou\jasperphp\src\JasperStarter\jdbc';
//        return [
//          'driver'   => 'generic',
//          'host'     => '127.0.0.1',//env('DB_HOST'),
//          'port'     => '3306',//env('DB_PORT'),
//          'username' => 'root',//env('DB_USERNAME'),
//          'password' => '',//env('DB_PASSWORD'),
//          'database' => 'tarquistore',//env('DB_DATABASE'),
//          'jdbc_driver' => 'com.mysql.jdbc.Driver',
//          'jdbc_url' => 'jdbc:mysql://tarquistore.test;databaseName=tarquistore',//.env('DB_DATABASE').'',
//          'jdbc_dir' =>  $jdbc_dir
//       ];
//    }

//      public function generateReport()
//     {   
          
//      $extensao = 'pdf' ;
//      $nome = 'testReportJaspers';
//      $filename =  $nome  . time();
//      $output = base_path('/public/reports/' . $filename);
 
//      JasperPHP::compile(storage_path('app/public'). '/relatorios/testReportJasper.jrxml')->execute();
    
     
     
//     //  JasperPHP::process(
//     //    storage_path('app/public/relatorios/testReportJasper.jasper') ,
//     //    $output,
//     //    array($extensao),
//     //    array('id' => 178),
//     //    $this->getDatabaseConfig(),
//     //    "en-US"
//     //  )->execute();
//  //execute    output
//         //  $file = $output .'.'.$extensao ;

       
//         //  return response()->file($file)->deleteFileAfterSend();
      
//         //  if (!file_exists($file)) {
//         //  abort(404);
//         //  }
//         //  if($extensao == 'xls')
//         //  {
//         //  header('Content-Description: Arquivo Excel');
//         //  header('Content-Type: application/x-msexcel');
//         //  header('Content-Disposition: attachment; filename="'.basename($file).'"');
//         //  header('Expires: 0');
//         //  header('Cache-Control: must-revalidate');
//         //  header('Pragma: public');
//         //  header('Content-Length: ' . filesize($file));
//         //  flush(); // Flush system output buffer
//         //  readfile($file);
//         //  unlink($file) ;
//         //  die();
//         //  }
//         //  else if ($extensao == 'pdf')
//         //  {
//         //      dd("else if");
//         //      //return response()->file($file)->deleteFileAfterSend();
//         //  }
//  /*
//     $file = $output .'.'.$extensao ;
//     if (!file_exists($file)) {
//       abort(404);
//     }
//     if($extensao == 'xls')
//      {
//        header('Content-Description: Arquivo Excel');
//        header('Content-Type: application/x-msexcel');
//        header('Content-Disposition: attachment; filename="'.basename($file).'"');
//        header('Expires: 0');
//        header('Cache-Control: must-revalidate');
//        header('Pragma: public');
//        header('Content-Length: ' . filesize($file));
//        flush(); // Flush system output buffer
//        readfile($file);
//        unlink($file) ;
//        die();
//      }
//      else if ($extensao == 'pdf')
//       {
//         return response()->file($file)->deleteFileAfterSend();
//       }
    
//     */
//     }



    
    public function reporteBlanco(){

        //$jdbc_dir = 'C:\laragon\www\TarquiStore\vendor\cossou\jasperphp\src\JasperStarter\jdbc';
       // $jdbc_dir = __DIR__ . '/vendor/geekcom/phpjasper/bin/jaspertarter/jdbc';
        $input = base_path() .'/public/reports/OrdenesCabecera.jrxml';
       // $database = \Config::get('database.connections.mysql');
        $jasper = new PHPJasper;
        $jasper->compile($input)->execute();
        //if ok

        $input2 = base_path() .'/public/reports/OrdenesCabecera.jasper';

        $output = base_path() . '/public/reports';
      
        $options = [
            'format' => ['pdf'],
            //'db_connection' => [$database]
            // 'locale' => 'en',
            // 'params' => [],
            // 'db_connection' => [
            //     'driver' => 'mysql',
            //     'host' => '127.0.0.1',
            //     'port' => '3306',
            //     'database' => 'tarquistore',
            //     'username' => 'root',
            //     'password' => '',
            //     'jdbc_driver' => 'com.mysql.jdbc.Driver',
            //     'jdbc_url' => 'jdbc:sqlserver://127.0.0.1;databaseName=tarquistore',
            //     'jdbc_dir' => $jdbc_dir
            // ]
        ];

    
        $jasper->process(
            $input,
            $output,
            $options
        )->execute();

        $pathToFile = base_path() .'/public/reports/OrdenesCabecera.pdf';
        return response()->file($pathToFile);
        // return response()->json([
        //     'status' => 'ok',
        //     'msj' => '¡Reporte compilado..!'
        // ]);
    }

}