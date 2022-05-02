<?php
require_once "config/baglanti.php";
$baglanti = new baglanti();
define("SITE_URL","http://localhost/LinkQisaltma");
require_once "template/header.php";


if(isset($_POST['deyisdir']))
{
    $link = strip_tags($_POST['link']);

    if(!empty($link)) //Əgər link areası boş deyilsə
    {
        if(filter_var($link,FILTER_VALIDATE_URL)) //və əgər həqiqətən daxil edilən linkdirsə
        {
            //ILK-Eyni linklərin daxil edilməməsi üçün metod
            $control = $baglanti->db->prepare("SELECT * FROM qisalt WHERE link = :link");
            $control->bindParam(":link",$link,PDO::PARAM_STR);
            $control->execute();
            $netice = $control->rowCount();

            if(empty($netice)) //DB`də həmin link yoxdursa
            {
                //SON-Eyni linklərin daxil edilməməsi üçün metod


                $kod = md5(uniqid()); //Uniqid PHP nin öz kodlama metodudu..md5 ilə daha sağlama almaq üçün edirik..Uzun pox kimi kod çıxır ortaya
                $kodQisa = substr($kod,0,6); //Uzun kodu qısaldıb 6simvollu edirik
                $elave_et = $baglanti->db->prepare("INSERT INTO qisalt(link,tarix,kod) VALUES(?,?,?)");
                $calisdir = $elave_et->execute(array($link,date("Y-m-d"),$kodKisa));

                if($calisdir)
                {
                    echo '<div class="goster">'.SITE_URL.'/go.php?kod='.$kodQisa.'</div>';
                }
                else
                {
                    echo "Link eklenemedi";
                }
            }
            else //Db`də həmin link varsa
            {
                $bul = $baglanti->db->prepare("SELECT * FROM Qisalt WHERE link = :link");
                $bul->bindParam(":link",$link,PDO::PARAM_STR);
                $bul->execute();
                $netice = $bul->fetch(PDO::FETCH_ASSOC);
                echo '<div class="goster">'.SITE_URL.'/go.php?kod='.$netice['kod'].'</div>';  //Həmin Linki ekrana yazdır
            }
        }
        else
        {
            echo "Link keçərli deyil";
        }
    }
    else
    {
        echo "Lütfən linkinizi daxil edin";
    }
}





?>

<div class="form">
    <div class="form-ic">
        <form action="" method="POST">

            <input type="text" name="link" placeholder="Linkinizi daxil edin...">
            <input type="submit" style="margin-top: 10px; background: #4c48ff; color: white; font-weight: 700; border: 0; padding: 10px;" name="deyisdir" value="Dəyişdir">

        </form>
    </div>
</div>
