<?php
require_once "config/baglanti.php";
require_once "config/helper.php";
require_once "config/process.php";

$baglanti = new baglanti();
//Helper static olduğu üçün tanımlamağa ehtiyac yoxdu
$process = new process();

$kod = strip_tags($_GET['kod']);
if(!empty($kod)) //Əgər kod boş deyilsə
{

    $netice = $process->sayiTap($kod);
    if($netice != 0)
    {
        $melumat = $process->melumatAl($kod);
        helper::yonlendir($melumat['link']);
    }
    else
    {
        helper::yonlendir("http://localhost/LinkQisaltma");
    }
}
else //Əgər kod boşdursa
{
    echo "Kod boşdur";
}