<?php
    use Mpdf\Mpdf;

    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new Mpdf();

    $data = file_get_contents("http://localhost/prescription/pdfcontent.php");

    $mpdf->WriteHTML($data);
    $mpdf->Output("D");
?>

<!-- <table class='table' >
        <tr >
            <td class='doc_info' colspan='4'>
                <h3>$full_name</h3>
                <h5>$designation, $designation2</h5>
                <h6>$hospital</h6>
                Email:$email Phone: $phone
            </td>
        </tr>
        <tr>
            <td >
                Name: $fname $lname 
            </td>
            <td >
                Age: $age
            </td>
            <td >
                Gendar: $sex
            </td>
            <td >
               Date: $date
            </td>
        </tr>
       
    </table> -->