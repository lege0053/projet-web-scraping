<?php
declare(strict_types=1);
require 'vendor/autoload.php';
require "../front/autoload.php";

class Forum
{
    private array $data = [];

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    public function __set(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public static function createFromId(int $id_act): self
    {
        $req = MyPDO::getInstance()->prepare(<<<SQL
                SELECT *
                FROM action
                WHERE id_act = ?
        SQL);

        $req->setFetchMode(PDO::FETCH_CLASS, Forum::class);
        $req->execute([$id_act]);
        $action = $req->fetch();
        if (!$action) {
            throw new InvalidArgumentException("Id de mat non existant dans la base de donnée.");
        }
        return $action;
    }

    public static function getAll(): array
    {
        $stat = MyPDO::getInstance()->prepare(<<<SQL
                SELECT *
                FROM forum
        SQL);
        $stat->setFetchMode(PDO::FETCH_CLASS, Forum::class);
        $stat->execute();
        return $stat->fetchAll();
    }

    public static function getAllByCodeAction($codeAction): array
    {
        $pdo = MyPDO::getInstance();
        $stat = $pdo->prepare(<<<SQL
                SELECT *
                FROM forum
                WHERE codeAction = :codeAction
        SQL);
        $stat->bindParam(':codeAction', $codeAction, PDO::PARAM_STR);
        $stat->setFetchMode(PDO::FETCH_CLASS, Forum::class);
        $stat->execute();
        return $stat->fetchAll();
    }

}
