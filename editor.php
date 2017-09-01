<?php session_start();      
        function composer(){
            echo '<div id="main" class=""><div id="content" class="editor">'; // Sets up he HTML for the editor
            $postId = htmlspecialchars($_GET["id"]); // Sets the HTML ID as a variable
            $post = "../posts/" . $postId . ".md"; // Appends the relative path of the file to the post ID
            $filename = "../posts/" . date("Y-m-d") . ".md";
            
            if(isset($_GET["id"]) || is_readable($filename)){ // Checks if the ?id is set or checks if a file is readable
                // **FIX THIS HACK IMMEDIATELY**
                // This check looks to see if the current date file is readable. It should instead append a number to $postId
                $deletable = true;
            }
            else{
                $deletable = false;
            }

            echo '
                <h1>Compose your Post</h1>
                <div id="edit-wrap">
                    <form action="writeToFile.php" target="previewpane" method="POST">
                        <textarea id="rawPost" name="postContent" rows="150" cols="150">
                '; // Creates text area and the form surrounding it

            if($deletable === true){
                echo file_get_contents($post); // Writes the content of the post to the text area
            }
            echo '
                        </textarea>
                        <p>
                            <input name="submit" type="submit"></input>
                            <button name="preview" type="submit">Preview</button>
                        </p>
                    </form>
                ';
            
            echo '<iframe src="" name="previewpane"></iframe>'; // This is the preview pane. It's awesome, but could be better.
            if($deletable === true){ // If this is an existing post, enable the delete button.
                echo '<a href="writeToFile.php/?id=' . $postId . '" target="previewpane" >Delete This Post</abutton>';
            }            
            echo '</div>';
            
            echo '</div></div>'; // Close out div blocks
        }

        if ($_SESSION['username'] == 'devmember'){
            composer(); // Checks if the user is logged in, then renders the composer
        }
        else{
            include "../login.php"; // If the user isn't logged in, it pushes you to a login page.
        }
?>