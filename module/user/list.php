<?php
    $no=1;
      
    $queryAdmin = mysqli_query($links, "SELECT * FROM user ORDER BY nama ASC");
      
    if(mysqli_num_rows($queryAdmin) == 0)
    {
        echo "<h3>Saat ini belum ada data user yang dimasukan</h3>";
    }
    else
    {
        echo "<table class='table-list'>";
          
            echo "<tr class='baris-title'>
                    <th class='number'>No</th>
                    <th class='left'>Nama</th>
                    <th class='left'>Email</th>
                    <th class='left'>Phone</th>
                    <th class='left'>Level</th>
                    <th class='middle'>Status</th>
                    <th class='middle'>Action</th>
                 </tr>";
  
            while($rowUser=mysqli_fetch_array($queryAdmin))
            {
                echo "<tr>
                        <td class='kolom-nomor'>$no</td>
                        <td>$rowUser[nama]</td>
                        <td>$rowUser[email]</td>
                        <td>$rowUser[phone]</td>
                        <td>$rowUser[level]</td>
                        <td class='middle'>$rowUser[status]</td>
                        <td class='middle'>
                            <a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=user&action=form&user_id=$rowUser[user_id]"."'>Edit
                            </a>
                            <a style='margin-left: 5px' class='tombol-action' href='".BASE_URL."module/user/action.php?button=Delete&user_id=$rowUser[user_id]"."'> Delete
                            </a>
                        </td>
                     </tr>";
              
                $no++;
            }
          
        //AKHIR DARI TABLE
        echo "</table>";
    }
?>