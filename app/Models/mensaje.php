<?php
class Mensaje{
    public static function all():array{
        $pdo=Database::getConnection();
        $st=$pdo->query("SELECT * FROM mensajes order by id desc");
        return $st->fetchAll();
    }
    public static function find( int $id): array{
        $pdo=Database::getConnection();
        $st=$pdo->query("SELECT*FROM mensajes where id=?");
        $st->execute([$id]);
        $r=$st->fetch();
        return $r ?: null;
    }
    public static function create(array $arr): int{
        $pdo=Database::getConnection();
        $st=$pdo->query("INSERT INTO mensajes(titulo, descripcion, fecha)");
        $st->execute([$arr['titulo'],$arr['descripcion'], $arr['fecha']]);
        return (int) $pdo->lastInsertId();
    }
    public static function update(int $id, array $arr): bool{
        $pdo=Database::getConnection();
        $st=$pdo->query("UPDATE mensajes SET titulo=?, descripcion=?, fecha=? WHERE id=?");
        $st->execute([$arr['titulo'],$arr['descripcion'], $arr['fecha'], $id]);
        return $st;
    }
    public static function delete(int $id): bool{
        $pdo=Database::getConnection();
        $st=$pdo->query("DELETE FROM mensajes WHERE id=?");
        $st->execute([$id]);
        return $st;
    }
}