<?php
    require('head.php');
/**
 * Created by PhpStorm.
 * User: Xiaomin
 * Date: 10/30/14
 * Time: 10:55 AM
 */


//mp3 music
?>


<script>
    $(document).ready(function() {
        $(".pro_content").hide();
        $(".file_content").hide();
        var show = true;
        $(".shrink").click(function() {
            if (show == true) {
                $('.catalogue').hide('slide', {direction: 'left'});
                show = false;
            } else {
                $('.catalogue').show('slide', {direction: 'right'});
            }
        });
        $(".shrink_two").click(function() {
            if (show == true) {
                $('.catalogue').hide('slide', {directino: 'left'});
                show = false;
            } else {
                $('.catalogue').show('slide', {direction: 'right'});
                show = true;
            }
        });
    });

    var nowShow = null;
    function project_chosen(title, real_title, date, version, summary) {
        $(".file_page").hide();
        $(".file_content").hide();
        $(".pro_content").hide();
        if (nowShow != title) {
            $("#" + title).slideDown();
            nowShow = title;
        } else {
            nowShow = null;
        }
        document.getElementById("project_title").innerHTML = "project: " + real_title;
        document.getElementById("project_date").innerHTML = "date: " + date;
        document.getElementById("project_version").innerHTML = "version: " + version;
        document.getElementById("project_summary").innerHTML = "summary: " + summary;
    }


    function file_chosen(name) {
        $(".file_page").hide();
        $(".file_content").hide();
        $("#" + name).slideToggle();
    }


    function load_file(file) {
        $(".file_page").show();
        $(".file_page").html('<object date=' + file + 'width = "97%" height = "600px" style = background-color:#ddd; overflow:auto; border:5px ridge blue"/>');
    }

</script>




<div class = "page">
    <div class = "catalogue">
        <div>
            <p> Catalogue: </p>
            <?php
            function dotDel($temp) {}
                $result = str_replace(".", "_", $temp);
                $result = str_replace("/", "_", $result);
                return $result;


            foreach($projects as $project) {
                echo "<div class = 'project'>";

            ?>
            <a href = '#' onclick = 'project_chosen("<?php echo (string)(dotDel($project->title));?>",
                "<?php echo $project->date?>",
                "<?php echo $project->version?>",
                "<?php echo $project->summary?>"
            <?php
                echo "<div class = 'pro_content' id = '".dotDel($project->title)."'>";
                foreach($project->files as $file) {
                    echo "<a href = '#' class = 'file' onclick = file_chosen('".dotDel($file->path)."')>".$file->path."</a><br>";
                }
                echo "</div>
                    </div>";
            }
            ?>
        </div>
    </div>

    <div class = "content">
        <div class = "shrink_two">
        </div>
        <p id = "project_title"></p>
        <p id = "project_date"></p>
        <p id = "project_version"></p>
        <p id = "project_summary"></p>
        <br>
        <?php
            foreach($projects as $project) {
                foreach($project->files as $file) {
                    echo "<div class = 'file_content' id = '".dotDel($file->path)."'>
                    <p>File/Address: ".$website."/".$file->path."</p>
                    <p>Size: ".$file->size."</p>
                    <p>Type: ".$file->type."</p>";
                    foreach($file->versions as $version) {
                        echo "
                            <br>
                            <p>Revision: ".$version->revision."</p>
                            <p>author: ".$version->author."</p>
                            <p>info: ".$version->info."</p>
                            <p>info: ".$version->date."</p>



                        ";
                    }

                    echo "<button type = 'button' onclick = load_file('".$website."/".$file->path."')>Load file</button>
                    </div>";
                }
            }
        ?>
        <div class = "file_page">
        </div>
    </div>
</div>
<?php
    require('tail.php');
?>
