
<?php
$table = get_field( 'table_item' );

        // echo '<pre>';
        // var_dump($table['header']);
        // echo '</pre>';
if ( ! empty ( $table ) ) {
	$count_trhead = 0;
	$count_tdhead = 0;
	$count_tr = 0;
    echo '<div class="table for-pc">';


        if ( ! empty( $table['header'] ) ) {

            echo '<div class="thead">';

                echo '<div class="tr tr_'. $count_trhead++ . '">';

                    foreach ( $table['header'] as $th ) {

                        echo '<div class="td td_'. $count_tdhead++ . '">';
                            echo $th['c'];
                        echo '</div>';
                    }

                echo '</div>';

            echo '</div>';
        }

        echo '<div class="tbody">';

            foreach ( $table['body'] as $tr ) {
				$count_td = 0;

                echo '<div class="tr tr_'. $count_tr++ . '">';

                    foreach ( $tr as $td ) {

                        echo '<div class="td td_'. $count_td++ . '">';
                            echo $td['c'];
                        echo '</div>';
                    }

                echo '</div>';
            }

        echo '</div>';

    echo '</div>';



    echo '<div class="table for-mobile">';

        if ( ! empty( $table['header'] ) ) {
        	$thm = [];
            foreach ( $table['header'] as $thc ) {
            	$thm[] = $thc['c'];
            	//th[1] = $th['c']
                    //echo $th['c'];
            }
        }


        $trmm = [];
        foreach ( $table['body'] as $key2 => $trc ) {
        	

            foreach ( $trc as $key3 => $tdm ) {  
            $trmm[$key2][$key3]  = $tdm['c'];
            //tr[0]  
                
            }

        }

     
		echo '<div class="title_head">' . $thm[0]. '</div>';
        foreach ($trmm as $rmmkey => $rmmvalue) {
			echo '<div class="table_item">';
    		foreach ($rmmvalue as $key => $value) {
	        	if ($key<1) {
		        	echo '<div class="thead tr">';
			        	echo '<div class="td">';
			        		echo $value;
		        		echo '</div>';

		        		echo '<div class="td">';
	        			echo '</div>';
	        		echo '</div>';
	        	} else {
	        		echo '<div class="body tr">';
	        			echo '<div class="td">';
	        				echo $thm[$key];
	        			echo '</div>';

	        			echo '<div class="td">';
	        			echo $value;
	        			echo '</div>';
	        		echo '</div>';
	        	}
    		}
    		echo '</div>';
        }
        echo '</div>';
        // echo '<pre>';
        // var_dump($thm);
        // echo '</pre>';
        // echo '<pre>';
        // var_dump($trmm);
        // echo '</pre>';



}