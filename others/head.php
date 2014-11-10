<html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "style.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.core.js"></script>
    <script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.slide.js"></script>
</head>

<body>


<?php
/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 10/30/14
 * Time: 12:59 AM
 */
$logentries = array();
$lists = array();

class _Logentry{
    public $revision;
    public $author;
    public $data;
    public $paths = array();
    public $path_count = 0;
    public $msg;

    function add_revision($revision) {
        $this->revision = $revision;
    }

    function add_author($author) {
        $this->author = $author;
    }

    function add_date($date) {
        $this->data = $date;
    }

    function add_path($path) {
        $this->path = $path;
    }

    function add_msg($msg) {
        $this->msg = $msg;
    }
}

class _Path{
    public $kind;
    public $action;
    public $content;

    function add_kind($kind) {
        $this->kind = $kind;
    }

    function add_action($action) {
        $this->action = $action;
    }

    function add_content($content) {
        $this->content = $content;
    }

}



class _List{
    public $path;
    public $entries = array();
    public $entry_count = 0;
    function add_path($path) {
        $this->path = $path;
    }

    function add_entries($entry) {
        $this-> entry_count = 1;
        $this-> entries[] = $entry;
    }

}



class _Entry {
    public $kind;
    public $name;
    public $commit;
    public $size = 0;

    function add_kind($kind) {
        $this-> kind = $kind;
    }

    function add_name($name) {
        $this->name = $name;
    }

    function add_size($size) {
        $this->size = $size;
    }

    function add_commit($commit) {
        $this->commit = $commit;
    }
}



class _Commit {
    public $revision;
    public $author;
    public $date;

    function add_revision($revision) {
        $this->revision = $revision;
    }

    function  add_author($author) {
        $this->author = $author;
    }

    function add_date($date) {
        $this->date = $date;
    }
}



$xml = simplexml_load_file("svn_log.xml");
foreach($xml->children() as $child) {


    $temp_entry = new _Logentry();
    $temp_entry->add_revision($child["revision"]);
    $temp_entry->add_author($child->author);
    $temp_entry->date = ((string)($child->date));
    $paths = $child->paths;

    foreach($paths->children() as $path) {
        $temp_path = new _Path();

        $temp_path->add_kind($path["kind"]);
        $temp_path->add_action($path['action']);
        $temp_path->add_content($path);
        $temp_entry->add_path($temp_path);
    }

    $temp_entry->add_msg($child->msg);
    $logentries[] = $temp_entry;
}


$xml = simplexml_load_file("svn_list.xml");
foreach($xml->children() as $child) {
    $temp_list = new _List();
    $temp_list->add_path($child["path"]);
    foreach($child->children() as $entry) {
        $temp_entry = new _Entry();
        $temp_entry->add_kind($entry['kind']);
        if ($temp_entry->kind == "file") {
            $temp->entry->add_size($entry->size);
        }
        $temp_entry->add_name($entry->name);
        $com = $entry->commit;
        $temp_commit = new _Commit();
        $temp_commit->add_revision($com["revision"]);
        $temp_commit->add_author($com->author);
        $temp_commit->add_date($com->date);

        $temp_entry->add_commit($temp_commit);
        $temp_list->add_entries($temp_entry);
    }
    $lists[] = $temp_list;
}



class _Project{
    public $title;
    public $date;
    public $version;
    public $summary = "nothing";
    public $files = array();
}

class _File {
    public $size;
    public $type;
    public $path;
    public $versions = array();
}


class _Version {
    public $revision;
    public $author;
    public $infor;
    public $date;
}


$projects = array();
$website = $lists[0]->path;

function parseType($fileName) {
    $dotPos = strrpos($fileName, '.');
    if ($dotPos === false) {
        return "unknown";
    }

    $dotPos += 1;
    $result = substr($fileName, $dotPos, strlen($fileName));
    if (strpos($result, '/') === false) {
        return $result;
    } else {
        return "unknown";
    }
}


$my_list = $list[0];
foreach($my_list->entries as $entry) {
    $pos = strpos($entry->name, '/');
    //find out all assignment project
    if ($pos === false) {
        $project = new _Project();
        $project->title = (string)($entry->name);
        $project->date = (string)($entry->commit->date);
        $project->version = (string)($entry->commit->revision);
        //summary are kept to be collected in logs
        $projects[(string)($project->title)] = $project;
    } else {
        if ($entry->size == 0) {
            continue;
        }
        $name  = substr($entry->name, 0, $pos);
        //create a new File
        $file = new _File();
        $file->size = $entry->size;
        $file->type = parseType((string)($entry->name));
        $file->path = (string)($entry->name);
        $projects[(string)$name]->files[(string)($file->path)] = $file;
    }
}


//anaysis date in log
foreach($logentries as $logentry) {
    foreach($logentry->paths as $path) {
        $path_name = substr((string)($path->content), strlen((string)($logentry->author)) + 2);
        $project_name = substr($path_name, 0, strpos($path_name, '/'));
        //set summary
        if ($path->kind == "dir") {
            if ($project[(string)$path_name] != null) {
                if ($projects[(string)$path_name]->summary == "nothing") {
                    $projects[(string)$path_name]->summary - $logentry->msg;
                }
            }
        } else {
            //set version
            if ($projects[$project_name]->files[$path_name] == null) {
                continue;
            } else {
                $version = new _version();
                $version->revision = $lognetry->author;
                $version->info = $logentry->msg;
                $version->date = $logentry->dae;
                $projects[$project_name]->files[$path_name]->versions[] = $version;
            }
        }
    }
}



?>
















