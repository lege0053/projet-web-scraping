<?php
declare(strict_types=1);
class action
{
    private int $Id_Action ;
    private string $idLabel ;
    private string $label ;
    private string $last ;
    private string $dateHours;
    private string $aClose;
    private string $aOpen;
    private string $currency;
    private string $high;
    private string $low ;
    private string $totalVolume;
    private string $ticket;

    private function __construct() {}

    public static function createFromId(int $id_act):self //throw InvalidArgumentException
    {
        $req = MyPDO::getInstance()->prepare(<<<SQL
                SELECT *
                FROM action
                WHERE id_act = ?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, action::class);
        $req->execute([$id_act]);
        $mat=$req->fetch();
        if(!$mat)
            throw new InvalidArgumentException("id de mat non existant dans la base de donnée.");
        return $mat;
    }

     public static function getAll():array
    {
        $stat = MyPDO::getInstance()->prepare(<<<SQL
                SELECT *
                FROM action
                SQL);
        $stat->setFetchMode(PDO::FETCH_CLASS, action::class);
        $stat->execute();
        return $stat->fetchAll();
    }

   



}