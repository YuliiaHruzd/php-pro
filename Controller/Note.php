<?php

namespace Controller;

class Note extends Controller
{
    const DIR_NAME = 'Notes';

    function index($id = null, $secondId = null)
    {
        echo $this->json(["data" => $this->dirToArray(self::DIR_NAME)]);
    }

    function show($id = null, $secondId = null)
    {
        echo $this->json(["data" => $this->dirToArray(self::DIR_NAME, $id)]);
    }

    function create($id = null, $secondId = null)
    {
        if (file_exists(self::DIR_NAME . DIRECTORY_SEPARATOR .$id . '.php')) {
            echo $this->json(["error" => 'note already exist']);
        } else {
            file_put_contents( self::DIR_NAME . DIRECTORY_SEPARATOR . $id . '.php', '' );
            echo $this->json(["data" => 'this is class ' . get_class($this)]);
        }
    }

    function update($id = null, $secondId = null)
    {
        if (!file_exists(self::DIR_NAME . DIRECTORY_SEPARATOR . $id . '.php')) {
            echo $this->json(["error" => 'file not exist']);
        } else {
            rename(self::DIR_NAME . DIRECTORY_SEPARATOR . $id . '.php', self::DIR_NAME . DIRECTORY_SEPARATOR . $secondId . '.php');
            echo $this->json(["data" => 'this is class ' . get_class($this)]);
        }
    }

    function delete($id = null, $secondId = null)
    {
        unlink(self::DIR_NAME . DIRECTORY_SEPARATOR . $id . '.php');
        echo $this->json(["data" => 'this is class ' . get_class($this)]);
    }

    function dirToArray($dir, $filter = null)
    {
        $result = [];
        $cdir = scandir($dir);

        foreach ($cdir as $key => $value)
        {
            if (!in_array($value, [".", ".."]))
            {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value) && $filter == $value)
                {
                    $result[$value] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                }
                else if ($filter == null)
                {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }
}
