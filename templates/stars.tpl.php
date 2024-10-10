<?php
    function makeNewRating($id) {
        ?>
        <style>
            .rating-<?php echo $id ?> {
                margin-bottom: 20px;
                display: flex;
                flex-direction: row-reverse; /* this is the magic */
                justify-content: flex-end;
            }

            .rating-<?php echo $id ?> input {
                display: none;
            }

            .rating-<?php echo $id ?> label {
                font-size: 24px;
                cursor: pointer;
            }
    
            .rating-<?php echo $id ?> label:hover,
            .rating-<?php echo $id ?> label:hover ~ label { /* reason why the stars are in reverse order in the html */
                color: orange;
            }

            .rating-<?php echo $id ?> input:checked ~ label {
                color: orange;
            }
        </style>


        <?php
        echo "<div class='rating-$id'>";
            echo "<input type='radio' id='star5-$id' name='rating-$id' value='5'>";
            echo "<label for='star5-$id'>&#9733;</label>";
            echo "<input type='radio' id='star4-$id' name='rating-$id' value='4'>";
            echo "<label for='star4-$id'>&#9733;</label>";
            echo "<input type='radio' id='star3-$id' name='rating-$id' value='3'>";
            echo "<label for='star3-$id'>&#9733;</label>";
            echo "<input type='radio' id='star2-$id' name='rating-$id' value='2'>";
            echo "<label for='star2-$id'>&#9733;</label>";
            echo "<input type='radio' id='star1-$id' name='rating-$id' value='1'>";
            echo "<label for='star1-$id'>&#9733;</label>";
        echo "</div>";
    }
?>
