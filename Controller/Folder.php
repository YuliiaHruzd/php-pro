<?php

namespace Controller;

class Folder extends Controller
{
    function index($id = null, $secondId = null)
    {
        echo $this->json($this->dirToArray('/'));
    }

    function show($id = null, $secondId = null)
    {
        echo $this->json(["data" => $this->dirToArray('/', $id)]);
    }

    function create($id = null, $secondId = null)
    {
        if (is_dir($id)) {
            echo $this->json(["error" => 'dir already exist']);
        } else {
            mkdir($id);
            echo $this->json(["data" => 'this is class ' . get_class($this)]);
        }
    }

    function update($id = null, $secondId = null)
    {
        if (!is_dir($id)) {
            echo $this->json(["error" => 'dir not exist']);
        } else {
            rename($id, $secondId);
            echo $this->json(["data" => 'this is class ' . get_class($this)]);
        }
    }

    function delete($id = null, $secondId = null)
    {
        rmdir($id);
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
