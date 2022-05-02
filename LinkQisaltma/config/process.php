<?php


class process extends baglanti
{
    public function sayiTap($kod)
    {
        $control = $this->db->prepare("SELECT * FROM qisalt WHERE kod = :kod");
        $control->bindParam(":kod",$kod,PDO::PARAM_STR);
        $control->execute();
        $netice = $control->rowCount();
        return $netice;
    }

    public function melumatAl($kod)
    {
        $control = $this->db->prepare("SELECT * FROM qisalt WHERE kod = :kod");
        $control->bindParam(":kod",$kod,PDO::PARAM_STR);
        $control->execute();
        $netice = $control->fetch(PDO::FETCH_ASSOC);
        return $netice;
    }
}