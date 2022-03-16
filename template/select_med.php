<div class="select_med">
    <h4 class="text-center">Select Medicine</h4>
    <form  method="POST" >
        <select class="form-control" id="select_med" name="select_med" required>
        <?php
            session_start();	
            include("db_con/database_con.php");
            $id = $_SESSION['pid'];
            if(isset($_POST['add_med'])){

                $select_med = $_POST['select_med'];
                $med_time = $_POST['m_time'];
                $med_use = $_POST['m_use'];

                $med_query = "INSERT INTO select_med(med, useage, duration, patient_id, added_date) 
                                VALUES ('$select_med','$med_time','$med_use','$id','$date')";
                $medresult = mysqli_query($conn, $med_query);
                if($medresult)
                    echo 'added';
                else 
                    echo 'Not added';
            }

            $query = "SELECT * FROM medicine ";
            $data = mysqli_query($conn, $query);
            
            while( $med = mysqli_fetch_array($data))
            {
            echo "<option value=".$med['mid'].">".$med['med_name']."</option>";
            }
            
        ?>
        </select>
        <input type="text" class="form-control" name="m_time" placeholder="0+0+0" >
        <input type="text" class="form-control" name="m_use" placeholder="Days/weeks/Months" >
        <input type="submit" name="add_med" class="btn btn-success" value="Add Medicine" >

    </form>
</div>
<div class="add_med">
    <p class="rx">Rx: </p>
    <table class="table table-bordered">
        <?php
            $t_query = "SELECT * FROM select_med ";
            $t_result = mysqli_query($conn, $t_query);
            $i=0;
            while($data= mysqli_fetch_array($t_result))
            {
                if($id == $data['patient_id'] && $date == $data['added_date']){
        ?>
            <tr>
                
                <td>
                    <?php 
                        $mid = $data['med'];
                        $query = "SELECT * FROM medicine WHERE mid='$mid'";
                        $data1 = mysqli_query($conn, $query);
                        $med1 = mysqli_fetch_array($data1);
                        echo $med1['med_name'];
                    ?>
                </td>
                <td><?php echo $data['useage'];?></td>
                <td><?php echo $data['duration'];?></td>
            </tr>
            <?php
                $i++;
                }
            }
            ?>
            
    </table>
</div>