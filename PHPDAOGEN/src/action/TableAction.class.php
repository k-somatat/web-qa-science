<?php
	class tableAction{
		function __construct($table){
			if($table_column = $this->getColumns($table)){
				$table_pk = $this->getPK($table);
				log_debug(get_class($this),"Get Table Columns Successful.");
				$this->SavePath($table);
				$DAO = $this->DAOFile($table_column,$table);
				$VO = $this->VOFile($table_column,$table);
				$BaseDAO = $this->BaseDAOFile($table_column,$table_pk,$table);
			}else{
				log_debug(get_class($this),"Fail to get Table Columns.");
			}
		}
		function getPK($table){
			$query = "SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE `TABLE_SCHEMA`='" . DB_NAME . "' AND `TABLE_NAME` = '" . $table . "' AND `COLUMN_KEY` =  'PRI'";
			$DB_CONNECT = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
			$DB_OBJECT = mysql_select_db(DB_NAME);
			try{
				if($DB_CONNECT){
					log_debug(get_class($this),"Database Connected.");
				}else{
					log_debug(get_class($this),"Database Connect Failed.");
				}
				log_debug(get_class($this),$query);
				if (!($stmt = mysql_query($query)) || $table == null) {
					log_debug(get_class($this),"Execute Fail: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
					return false;
				}
				else{
					log_debug(get_class($this),"Statement Executed.");
					$i=0;
					while($output = mysql_fetch_array($stmt)){
						$table_pk['COLUMN_NAME'][] = $output['COLUMN_NAME'];
						$table_pk['DATA_TYPE'][] = $output['DATA_TYPE'];
						log_debug(get_class($this), "Select Item: [" . $table_pk['COLUMN_NAME'][$i] . "]");
						log_debug(get_class($this), "Select Item: [" . $table_pk['DATA_TYPE'][$i++] . "]");
					}
					if($table_pk == null){
						log_debug(get_class($this),"This Table not have pk! Please check Table name.");
						return false;
					}else{
						return $table_pk;
					}
				}
			}catch(Exception $e){
				log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
			}
			mysqli_close($DB_CONNECT);
		}
		function getColumns($table){
			$query = "SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE `TABLE_SCHEMA`='" . DB_NAME . "' AND `TABLE_NAME` = '" . $table . "'";
			$DB_CONNECT = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
			$DB_OBJECT = mysql_select_db(DB_NAME);

			try{
				if($DB_CONNECT){
					log_debug(get_class($this),"Database Connected.");
				}else{
					log_debug(get_class($this),"Database Connect Failed.");
				}
				log_debug(get_class($this),$query);
				if (!($stmt = mysql_query($query)) || $table == null) {
					log_debug(get_class($this),"Execute Fail: (" . $DB_CONNECT->errno . ") " . $DB_CONNECT->error);
					return false;
				}
				else{
					log_debug(get_class($this),"Statement Executed.");
					$i=0;
					while($output = mysql_fetch_array($stmt)){
						$table_columns['COLUMN_NAME'][] = $output['COLUMN_NAME'];
						$table_columns['DATA_TYPE'][] = $output['DATA_TYPE'];
						log_debug(get_class($this), "Select Item: [" . $table_columns['COLUMN_NAME'][$i] . "]");
						log_debug(get_class($this), "Select Item: [" . $table_columns['DATA_TYPE'][$i++] . "]");
					}
					if($table_columns == null){
						log_debug(get_class($this),"This Table not have column! Please check Table name.");
						return false;
					}else{
						return $table_columns;
					}
				}
			}catch(Exception $e){
				log_debug(get_class($this),"Error: " . $DB_CONNECT->error);
			}
			mysqli_close($DB_CONNECT);
		}
		

		function DAOFile($table_column,$table){
			$parts = explode('_', $table);
			foreach($parts as $s){
				$name .= ucfirst($s);
			}
			$DAO .= "<?php\n"
					. "\trequire_once('BaseDao/" . $name . "BaseDAO.class.php');\n\n"
					. "\tclass ". $name . "DAO extends " . $name . "BaseDAO{\n\n"
					. "\t}\n"
					. "?>";
			if(!is_dir("gen/src/DAO")){
				mkdir("gen/src/DAO", 0, true);
			}
			if(fopen(filePathDAO, 'w')){
				log_debug(get_class($this),"Create File [" . filePathDAO . "] Success.");
			}else{
					log_debug(get_class($this),"Fail to create file.");
			}
			file_put_contents(filePathDAO, $DAO ,LOCK_EX);
			return $DAO;
		}
		
		function BaseDAOFile($table_column,$table_pk,$table){
			$parts = explode('_', $table);
			foreach($parts as $s){
				$name .= ucfirst($s);
			}
			
			$count = 0;
			$len = count($table_pk['COLUMN_NAME']);
			foreach($table_pk['COLUMN_NAME'] as $s){
				if($len == 1){
					$pk .= "$" . $s;
					$sqlpk .= "$s = ?";
					$inputpk .= ". $" . $s . " .";
				}
				else if($count == 0){
					$pk .= "$" . $s.", ";
					$sqlpk .= "$s = ? AND ";
					$inputpk .= ". $" . $s . " . \", \"";
				}
				else if($count == $len - 1){
					$pk .= "$" . $s;
					$sqlpk .= "$s = ?";
					$inputpk .= ". $" . $s . " .";
				}
				else{
					$pk .= "$" . $s .", ";
					$sqlpk .= "$s = ? AND ";
					$inputpk .= ". $" . $s . " . \", \"";
				}
				$count++;
			}
			
			$BaseDAO .= "<?php\n"
						. "require_once (ABSPATH . 'src/vo/" . $name . ".class.php');\n"
						. "class " . $name . "BaseDAO{\n\n"
						. "\tpublic function __construct() {\n"
						. "\t\t\$vo = new " . $name . "();\n"
						. "\t}\n\n";
			
			
			// Insert
			
			$insert .= 	"\tfunction insert($" . $table . ") {\n"
						. "\t\t\$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);\n"
                        . "\t\t\$DB_CONNECT->set_charset('utf8');\n"
						. "\t\t\$db_insert = \"(";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$insert .= $s . ",\n";
				}
				else if($count == $len - 1){
					$insert .= "\t\t\t\t\t" . $s;
				}
				else{
					$insert .= "\t\t\t\t\t" . $s . ",\n";
				}
				$count++;
			}
			$insert .= 	")\";\n"
						. "\t\ttry{\n"
						. "\t\t\tif(\$DB_CONNECT){\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connected.\");\n"
						. "\t\t\t}else{\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connect Failed.\");\n"
						. "\t\t\t}\n"
						. "\t\t\t\$query = \"INSERT INTO $table \" . \$db_insert . \" VALUES (";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$insert .= " ?,";
				}
				else if($count == $len - 1){
					$insert .= " ?";
				}
				else{
					$insert .= " ?,";
				}
				$count++;
			}
			$insert .= 	")\";\n"
						. "\t\t\tlog_debug(get_class(\$this),\$query);\n"
						. "\t\t\tif (!(\$stmt = \$DB_CONNECT->prepare(\$query))) {\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Prepare failed: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
						. "\t\t\t}\n"
						. "\t\t\t\$stmt->bind_param(\"";
			foreach($table_column['DATA_TYPE'] as $s){
				if($s == "int"){
					$insert .= "i";
				}
				else if($s == "tinyint"){
					$insert .= "i";
				}
				else if($s == "smallint"){
					$insert .= "i";
				}
				else if($s == "mediumint"){
					$insert .= "i";
				}
				else if($s == "bigint"){
					$insert .= "i";
				}
				else if($s == "bool"){
					$insert .= "i";
				}
				else if($s == "float"){
					$insert .= "d";
				}
				else if($s == "double"){
					$insert .= "d";
				}
				else if($s == "decimal"){
					$insert .= "d";
				}
				else if($s == "varchar"){
					$insert .= "s";
				}
				else if($s == "char"){
					$insert .= "s";
				}
				else if($s == "text"){
					$insert .= "s";
				}
				else if($s == "tinytext"){
					$insert .= "s";
				}
				else if($s == "mediumtext"){
					$insert .= "s";
				}
				else if($s == "longtext"){
					$insert .= "s";
				}
				else if($s == "date"){
					$insert .= "s";
				}
				else if($s == "datetime"){
					$insert .= "s";
				}
				else if($s == "timestamp"){
					$insert .= "s";
				}
				else if($s == "time"){
					$insert .= "s";
				}
				else if($s == "year"){
					$insert .= "s";
				}
				else if($s == "blob"){
					$insert .= "b";
				}
				else if($s == "tinyblob"){
					$insert .= "b";
				}
				else if($s == "mediumblob"){
					$insert .= "b";
				}
				else if($s == "longblob"){
					$insert .= "b";
				}
				$count++;
			}
			$insert .=	"\",\n";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$insert .= "\t\t\t\t\t$" . $table . "->" . $s . ",\n";
				}
				else if($count == $len - 1){
					$insert .= "\t\t\t\t\t$" . $table . "->" . $s . "\n";
				}
				else{
					$insert .= "\t\t\t\t\t$" . $table . "->" . $s . ",\n";
				}
				$count++;
			}
			$insert .=	"\t\t\t\t);\n\n"
						. "\t\t\tif(\$stmt->execute()){\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Insert Table $table \" . \$" . $table . "->" . $table_column['COLUMN_NAME'][0] . ". \" Success.\");\n"
						. "\t\t\t}else{\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Insert Error: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
						. "\t\t\t}\n"
						. "\t\t}catch(Exception \$e){\n"
						. "\t\t\tlog_debug(get_class(\$this),\"Error: \" . \$DB_CONNECT->error);\n"
						. "\t\t}\n"
						. "\t\tmysqli_close(\$DB_CONNECT);\n"
						. "\t}\n";
			
			// Update
				
			$update .= 	"\tfunction update($" . $table . ") {\n"
						. "\t\t\$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);\n"
                        . "\t\t\$DB_CONNECT->set_charset('utf8');\n"
						. "\t\t\$db_update = \"";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
//					$update .= $s . " = ?,\n";
					$update .= "SET\n";
				}
				else if($count == $len - 1){
					$update .= "\t\t\t\t\t" . $s . " = ?\n";
				}
				else{
					$update .= "\t\t\t\t\t" . $s . "  = ?,\n";
				}
				$count++;
			}
			$update .= 	"\t\t\t\t\tWHERE " . $table_column['COLUMN_NAME'][0] . " = ?\";\n"
					. "\t\ttry{\n"
					. "\t\t\tif(\$DB_CONNECT){\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connected.\");\n"
					. "\t\t\t}else{\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connect Failed.\");\n"
					. "\t\t\t}\n"
					. "\t\t\t\$query = \"UPDATE  $table SET \". \$db_update;\n"
					. "\t\t\tlog_debug(get_class(\$this),\$query);\n"
					. "\t\t\tif (!(\$stmt = \$DB_CONNECT->prepare(\$query))) {\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Prepare failed: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
					. "\t\t\t}\n"
					. "\t\t\t\$stmt->bind_param(\"";
			foreach($table_column['DATA_TYPE'] as $s){
				if($s == "int"){
					$update .= "i";
				}
				else if($s == "tinyint"){
					$update .= "i";
				}
				else if($s == "smallint"){
					$update .= "i";
				}
				else if($s == "mediumint"){
					$update .= "i";
				}
				else if($s == "bigint"){
					$update .= "i";
				}
				else if($s == "bool"){
					$update .= "i";
				}
				else if($s == "float"){
					$update .= "d";
				}
				else if($s == "double"){
					$update .= "d";
				}
				else if($s == "decimal"){
					$update .= "d";
				}
				else if($s == "varchar"){
					$update .= "s";
				}
				else if($s == "char"){
					$update .= "s";
				}
				else if($s == "text"){
					$update .= "s";
				}
				else if($s == "tinytext"){
					$update .= "s";
				}
				else if($s == "mediumtext"){
					$update .= "s";
				}
				else if($s == "longtext"){
					$update .= "s";
				}
				else if($s == "date"){
					$update .= "s";
				}
				else if($s == "datetime"){
					$update .= "s";
				}
				else if($s == "timestamp"){
					$update .= "s";
				}
				else if($s == "time"){
					$update .= "s";
				}
				else if($s == "year"){
					$update .= "s";
				}
				else if($s == "blob"){
					$update .= "b";
				}
				else if($s == "tinyblob"){
					$update .= "b";
				}
				else if($s == "mediumblob"){
					$update .= "b";
				}
				else if($s == "longblob"){
					$update .= "b";
				}
				$count++;
			}
			$update .=	"\",\n";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
//					$update .= "\t\t\t\t\t$" . $table . "->" . $s . ",\n";
				}
				else if($count == $len - 1){
					$update .= "\t\t\t\t\t$" . $table . "->" . $s . ",\n";
				}
				else{
					$update .= "\t\t\t\t\t$" . $table . "->" . $s . ",\n";
				}
				$count++;
			}
			$update .=	"\t\t\t\t\t$" . $table . "->" . $table_column['COLUMN_NAME'][0] . "\n" 
					. "\t\t\t\t);\n\n"
					. "\t\t\tif(\$stmt->execute()){\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Update Table $table \" . \$" . $table . "->" . $table_column['COLUMN_NAME'][0] . ". \" Success.\");\n"
					. "\t\t\t}else{\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Update Error: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
					. "\t\t\t}\n"
					. "\t\t}catch(Exception \$e){\n"
					. "\t\t\tlog_debug(get_class(\$this),\"Error: \" . \$DB_CONNECT->error);\n"
					. "\t\t}\n"
					. "\t\tmysqli_close(\$DB_CONNECT);\n"
					. "\t}\n";
			
			// Delete
			
			$delete .= 	"\tfunction delete($" . $table . ") {\n"
						. "\t\tlog_debug(get_class(\$this),\"Input : [\" . $" . $table . " . \"].\");\n"
						. "\t\t\$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);\n";
					
			$delete .= 	"\t\ttry{\n"
					. "\t\t\tif(\$DB_CONNECT){\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connected.\");\n"
					. "\t\t\t}else{\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connect Failed.\");\n"
					. "\t\t\t}\n"
					. "\t\t\t\$query = \"DELETE FROM $table WHERE ". $table_column['COLUMN_NAME'][0] . " = ?\";\n"
					. "\t\t\tlog_debug(get_class(\$this),\$query);\n"
					. "\t\t\tif (!(\$stmt = \$DB_CONNECT->prepare(\$query))) {\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Prepare failed: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
					. "\t\t\t}\n"
					. "\t\t\t\$stmt->bind_param(\"";
			foreach($table_column['DATA_TYPE'] as $s){
				if($s == "int"){
					$delete .= "i";
				}
				else if($s == "tinyint"){
					$delete .= "i";
				}
				else if($s == "smallint"){
					$delete .= "i";
				}
				else if($s == "mediumint"){
					$delete .= "i";
				}
				else if($s == "bigint"){
					$delete .= "i";
				}
				else if($s == "bool"){
					$delete .= "i";
				}
				else if($s == "float"){
					$delete .= "d";
				}
				else if($s == "double"){
					$delete .= "d";
				}
				else if($s == "decimal"){
					$delete .= "d";
				}
				else if($s == "varchar"){
					$delete .= "s";
				}
				else if($s == "char"){
					$delete .= "s";
				}
				else if($s == "text"){
					$delete .= "s";
				}
				else if($s == "tinytext"){
					$delete .= "s";
				}
				else if($s == "mediumtext"){
					$delete .= "s";
				}
				else if($s == "longtext"){
					$delete .= "s";
				}
				else if($s == "date"){
					$delete .= "s";
				}
				else if($s == "datetime"){
					$delete .= "s";
				}
				else if($s == "timestamp"){
					$delete .= "s";
				}
				else if($s == "time"){
					$delete .= "s";
				}
				else if($s == "year"){
					$delete .= "s";
				}
				else if($s == "blob"){
					$delete .= "b";
				}
				else if($s == "tinyblob"){
					$delete .= "b";
				}
				else if($s == "mediumblob"){
					$delete .= "b";
				}
				else if($s == "longblob"){
					$delete .= "b";
				}
				$count++;
				break;
			}
			$delete .=	"\",\n";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$delete .= "\t\t\t\t\t$" . $table . "->" . $s . "\n";
				}
				else if($count == $len - 1){
					$delete .= "\t\t\t\t\t$" . $table . "->" . $s . ",\n";
				}
				else{
					$delete .= "\t\t\t\t\t$" . $table . "->" . $s . ",\n";
				}
				$count++;
				break;
			}
			$delete .=	"\t\t\t\t);\n\n"
					. "\t\t\tif(\$stmt->execute()){\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Delete Table $table \" . \$" . $table . "->" . $table_column['COLUMN_NAME'][0] . ". \" Success.\");\n"
					. "\t\t\t}else{\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Delete Error: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
					. "\t\t\t}\n"
					. "\t\t}catch(Exception \$e){\n"
					. "\t\t\tlog_debug(get_class(\$this),\"Error: \" . \$DB_CONNECT->error);\n"
					. "\t\t}\n"
					. "\t\tmysqli_close(\$DB_CONNECT);\n"
					. "\t}\n";
			
			// Find By PK
			
			$findbypk .= 	"\tfunction findbyPK(" . $pk . ") {\n"
							. "\t\tlog_debug(get_class(\$this),\"Input : [\" $inputpk \"].\");\n"
							. "\t\t\$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);\n"
                            . "\t\t\$DB_CONNECT->set_charset('utf8');\n";
			
			$findbypk .= 	"\t\ttry{\n"
					. "\t\t\tif(\$DB_CONNECT){\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connected.\");\n"
					. "\t\t\t}else{\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connect Failed.\");\n"
					. "\t\t\t}\n"
					. "\t\t\t\$query = \"SELECT * FROM $table WHERE ". $sqlpk . "\";\n"
					. "\t\t\tlog_debug(get_class(\$this),\$query);\n"
					. "\t\t\tif (!(\$stmt = \$DB_CONNECT->prepare(\$query))) {\n"
					. "\t\t\t\tlog_debug(get_class(\$this),\"Prepare failed: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
					. "\t\t\t}\n"
					. "\t\t\t\$stmt->bind_param(\"";
			foreach($table_pk['DATA_TYPE'] as $s){
				if($s == "int"){
					$findbypk .= "i";
				}
				else if($s == "tinyint"){
					$findbypk .= "i";
				}
				else if($s == "smallint"){
					$findbypk .= "i";
				}
				else if($s == "mediumint"){
					$findbypk .= "i";
				}
				else if($s == "bigint"){
					$findbypk .= "i";
				}
				else if($s == "bool"){
					$findbypk .= "i";
				}
				else if($s == "float"){
					$findbypk .= "d";
				}
				else if($s == "double"){
					$findbypk .= "d";
				}
				else if($s == "decimal"){
					$findbypk .= "d";
				}
				else if($s == "varchar"){
					$findbypk .= "s";
				}
				else if($s == "char"){
					$findbypk .= "s";
				}
				else if($s == "text"){
					$findbypk .= "s";
				}
				else if($s == "tinytext"){
					$findbypk .= "s";
				}
				else if($s == "mediumtext"){
					$findbypk .= "s";
				}
				else if($s == "longtext"){
					$findbypk .= "s";
				}
				else if($s == "date"){
					$findbypk .= "s";
				}
				else if($s == "datetime"){
					$findbypk .= "s";
				}
				else if($s == "timestamp"){
					$findbypk .= "s";
				}
				else if($s == "time"){
					$findbypk .= "s";
				}
				else if($s == "year"){
					$findbypk .= "s";
				}
				else if($s == "blob"){
					$findbypk .= "b";
				}
				else if($s == "tinyblob"){
					$findbypk .= "b";
				}
				else if($s == "mediumblob"){
					$findbypk .= "b";
				}
				else if($s == "longblob"){
					$findbypk .= "b";
				}
			}
			$findbypk .=	"\",\n";
			$count = 0;
			$len = count($table_pk['COLUMN_NAME']);
			echo $len;
			foreach($table_pk['COLUMN_NAME'] as $s){
				if($len == 1){
					$findbypk .= "\t\t\t\t\t$" . $table_pk['COLUMN_NAME'][$count] . "\n";
				}
				else if($count == 0){
					$findbypk .= "\t\t\t\t\t$" . $table_pk['COLUMN_NAME'][$count] . ",\n";
				}
				else if($count == $len - 1){
					$findbypk .= "\t\t\t\t\t$" . $table_pk['COLUMN_NAME'][$count] . "\n";;
				}
				else{
					$findbypk .= "\t\t\t\t\t$" . $table_pk['COLUMN_NAME'][$count] . ",\n";
				}
				$count++;
			}
			$findbypk .=	"\t\t\t\t);\n\n"
							. "\t\t\tif(\$stmt->execute()){\n"
							. "\t\t\t\t\$row = \$stmt->bind_result(";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$findbypk .= "$" . $s . ", ";
				}
				else if($count == $len - 1){
					$findbypk .= "$" . $s . ");\n";
				}
				else{
					$findbypk .= "$" . $s . ", ";
				}
				$count++;
			}		
			$findbypk .=	"\t\t\t\twhile(\$stmt->fetch()){\n";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$findbypk .= "\t\t\t\t\t\$vo['" . $s . "'][] = $" . $s . ";\n";
				}
				else if($count == $len - 1){
					$findbypk .= "\t\t\t\t\t\$vo['" . $s . "'][] = $" . $s . ";\n";
				}
				else{
					$findbypk .= "\t\t\t\t\t\$vo['" . $s . "'][] = $" . $s . ";\n";
				}
				$count++;
			}	
			$findbypk .=	 "\t\t\t\t\tlog_debug(get_class(\$this),\"Select Item: \\n\"\n";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$findbypk .= "\t\t\t\t\t\t\t\t\t\t\t . \"[\" . $" . $s . " . \"]\\n\"\n";
				}
				else if($count == $len - 1){
					$findbypk .= "\t\t\t\t\t\t\t\t\t\t\t . \"[\" . $" . $s . " . \"]\\n\");\n";
				}
				else{
					$findbypk .= "\t\t\t\t\t\t\t\t\t\t\t . \"[\" . $" . $s . " . \"]\\n\"\n";
				}
				$count++;
			}
			$findbypk .=	"\t\t\t\t}\n"
							. "\t\t\t\treturn \$vo;\n"
							. "\t\t\t\tlog_debug(get_class(\$this),\"Find By PK $table \" . \$" . $table . "->" . $table_column['COLUMN_NAME'][0] . ". \" Success.\");\n"
							. "\t\t\t}else{\n"
							. "\t\t\t\tlog_debug(get_class(\$this),\"Find By PK Error: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
							. "\t\t\t}\n"
							. "\t\t}catch(Exception \$e){\n"
							. "\t\t\tlog_debug(get_class(\$this),\"Error: \" . \$DB_CONNECT->error);\n"
							. "\t\t}\n"
							. "\t\tmysqli_close(\$DB_CONNECT);\n"
							. "\t}\n";
			
			// Find All
			
			$findall .= 	"\tfunction findAll() {\n"
							. "\t\t\$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);\n"
                            . "\t\t\$DB_CONNECT->set_charset('utf8');\n";
				
			$findall .= 	"\t\ttry{\n"
							. "\t\t\tif(\$DB_CONNECT){\n"
							. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connected.\");\n"
							. "\t\t\t}else{\n"
							. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connect Failed.\");\n"
							. "\t\t\t}\n"
							. "\t\t\t\$query = \"SELECT * FROM  $table\";\n"
							. "\t\t\tlog_debug(get_class(\$this),\$query);\n"
							. "\t\t\tif (!(\$stmt = \$DB_CONNECT->prepare(\$query))) {\n"
							. "\t\t\t\tlog_debug(get_class(\$this),\"Prepare failed: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
							. "\t\t\t}\n";
			
			$findall .=	"\t\t\tif(\$stmt->execute()){\n"
						. "\t\t\t\t\$row = \$stmt->bind_result(";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$findall .= "$" . $s . ", ";
				}
				else if($count == $len - 1){
					$findall .= "$" . $s . ");\n";
				}
				else{
					$findall .= "$" . $s . ", ";
				}
				$count++;
			}
			$findall .=	"\t\t\t\twhile(\$stmt->fetch()){\n";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$findall .= "\t\t\t\t\t\$vo['" . $s . "'][] = $" . $s . ";\n";
				}
				else if($count == $len - 1){
					$findall .= "\t\t\t\t\t\$vo['" . $s . "'][] = $" . $s . ";\n";
				}
				else{
					$findall .= "\t\t\t\t\t\$vo['" . $s . "'][] = $" . $s . ";\n";
				}
				$count++;
			}
			$findall .=	 "\t\t\t\t\tlog_debug(get_class(\$this),\"Select Item: \\n\"\n";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$findall .= "\t\t\t\t\t\t\t\t\t\t\t . \"[\" . $" . $s . " . \"]\\n\"\n";
				}
				else if($count == $len - 1){
					$findall .= "\t\t\t\t\t\t\t\t\t\t\t . \"[\" . $" . $s . " . \"]\\n\");\n";
				}
				else{
					$findall .= "\t\t\t\t\t\t\t\t\t\t\t . \"[\" . $" . $s . " . \"]\\n\"\n";
				}
				$count++;
			}
			$findall .=	"\t\t\t\t}\n"
						. "\t\t\t\treturn \$vo;\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Find All $table Success.\");\n"
						. "\t\t\t}else{\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Find All Error: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
						. "\t\t\t}\n"
						. "\t\t}catch(Exception \$e){\n"
						. "\t\t\tlog_debug(get_class(\$this),\"Error: \" . \$DB_CONNECT->error);\n"
						. "\t\t}\n"
						. "\t\tmysqli_close(\$DB_CONNECT);\n"
						. "\t}\n";
			
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			
			
			$BaseDAO .= $insert; 
			$BaseDAO .= $update;
			$BaseDAO .= $delete;
			$BaseDAO .= $findbypk;
			$BaseDAO .= $findall;
			
			$countitem=0;
			foreach($table_column['COLUMN_NAME'] as $col){
				$name = "";
				$parts = explode('_', $col);
				foreach($parts as $s){
					$name .= ucfirst($s);
				}
				$BaseDAO .= "\tfunction findby" . $name . "($" . $table . ") {\n"
							. "\t\tlog_debug(get_class(\$this),\"Input : [\" . $" . $table . " . \"].\");\n"
							. "\t\t\$DB_CONNECT = new MySQLi(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);\n"
                            . "\t\t\$DB_CONNECT->set_charset('utf8');\n";
					
				$BaseDAO .= "\t\ttry{\n"
						. "\t\t\tif(\$DB_CONNECT){\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connected.\");\n"
						. "\t\t\t}else{\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Database Connect Failed.\");\n"
						. "\t\t\t}\n"
						. "\t\t\t\$query = \"SELECT * FROM $table WHERE ". $col . " = ?\";\n"
						. "\t\t\tlog_debug(get_class(\$this),\$query);\n"
						. "\t\t\tif (!(\$stmt = \$DB_CONNECT->prepare(\$query))) {\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Prepare failed: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
						. "\t\t\t}\n"
						. "\t\t\t\$stmt->bind_param(\"";
				$s = $table_column['DATA_TYPE'][$countitem];
				if($s == "int"){
					$BaseDAO .= "i";
				}
				else if($s == "tinyint"){
					$BaseDAO .= "i";
				}
				else if($s == "smallint"){
					$BaseDAO .= "i";
				}
				else if($s == "mediumint"){
					$BaseDAO .= "i";
				}
				else if($s == "bigint"){
					$BaseDAO .= "i";
				}
				else if($s == "bool"){
					$BaseDAO .= "i";
				}
				else if($s == "float"){
					$BaseDAO .= "d";
				}
				else if($s == "double"){
					$BaseDAO .= "d";
				}
				else if($s == "decimal"){
					$BaseDAO .= "d";
				}
				else if($s == "varchar"){
					$BaseDAO .= "s";
				}
				else if($s == "char"){
					$BaseDAO .= "s";
				}
				else if($s == "text"){
					$BaseDAO .= "s";
				}
				else if($s == "tinytext"){
					$BaseDAO .= "s";
				}
				else if($s == "mediumtext"){
					$BaseDAO .= "s";
				}
				else if($s == "longtext"){
					$BaseDAO .= "s";
				}
				else if($s == "date"){
					$BaseDAO .= "s";
				}
				else if($s == "datetime"){
					$BaseDAO .= "s";
				}
				else if($s == "timestamp"){
					$BaseDAO .= "s";
				}
				else if($s == "time"){
					$BaseDAO .= "s";
				}
				else if($s == "year"){
					$BaseDAO .= "s";
				}
				else if($s == "blob"){
					$BaseDAO .= "b";
				}
				else if($s == "tinyblob"){
					$BaseDAO .= "b";
				}
				else if($s == "mediumblob"){
					$BaseDAO .= "b";
				}
				else if($s == "longblob"){
					$BaseDAO .= "b";
				}
				
				$BaseDAO .=	"\",\n";
				$BaseDAO .= "\t\t\t\t\t$" . $table . "\n";
				$BaseDAO .=	"\t\t\t\t);\n\n"
						. "\t\t\tif(\$stmt->execute()){\n"
								. "\t\t\t\t\$row = \$stmt->bind_result(";
				$count = 0;
				$len = count($table_column['COLUMN_NAME']);
				foreach($table_column['COLUMN_NAME'] as $s){
					if($count == 0){
						$BaseDAO .= "$" . $s . ", ";
					}
					else if($count == $len - 1){
						$BaseDAO .= "$" . $s . ");\n";
					}
					else{
						$BaseDAO .= "$" . $s . ", ";
					}
					$count++;
				}
				$BaseDAO .=	"\t\t\t\twhile(\$stmt->fetch()){\n";
				$count = 0;
				$len = count($table_column['COLUMN_NAME']);
				foreach($table_column['COLUMN_NAME'] as $s){
					if($count == 0){
						$BaseDAO .= "\t\t\t\t\t\$vo['" . $s . "'][] = $" . $s . ";\n";
					}
					else if($count == $len - 1){
						$BaseDAO .= "\t\t\t\t\t\$vo['" . $s . "'][] = $" . $s . ";\n";
					}
					else{
						$BaseDAO .= "\t\t\t\t\t\$vo['" . $s . "'][] = $" . $s . ";\n";
					}
					$count++;
				}
				$BaseDAO .=	 "\t\t\t\t\tlog_debug(get_class(\$this),\"Select Item: \\n\"\n";
				$count = 0;
				$len = count($table_column['COLUMN_NAME']);
				foreach($table_column['COLUMN_NAME'] as $s){
					if($count == 0){
						$BaseDAO .= "\t\t\t\t\t\t\t\t\t\t\t . \"[\" . $" . $s . " . \"]\\n\"\n";
					}
					else if($count == $len - 1){
						$BaseDAO .= "\t\t\t\t\t\t\t\t\t\t\t . \"[\" . $" . $s . " . \"]\\n\");\n";
					}
					else{
						$BaseDAO .= "\t\t\t\t\t\t\t\t\t\t\t . \"[\" . $" . $s . " . \"]\\n\"\n";
					}
					$count++;
				}
				$BaseDAO .=	"\t\t\t\t}\n"
						. "\t\t\t\treturn \$vo;\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Find " . $name . " $table \" . \$" . $table . "->" . $table_column['COLUMN_NAME'][0] . ". \" Success.\");\n"
						. "\t\t\t}else{\n"
						. "\t\t\t\tlog_debug(get_class(\$this),\"Find " . $name . " Error: (\" . \$DB_CONNECT->errno . \") \" . \$DB_CONNECT->error);\n"
						. "\t\t\t}\n"
						. "\t\t}catch(Exception \$e){\n"
						. "\t\t\tlog_debug(get_class(\$this),\"Error: \" . \$DB_CONNECT->error);\n"
						. "\t\t}\n"
						. "\t\tmysqli_close(\$DB_CONNECT);\n"
						. "\t}\n";
			
				$countitem++;
			}
			
			
			
			
			$BaseDAO .= "}";
			if(!is_dir("gen/src/DAO/BaseDAO")){
				mkdir("gen/src/DAO/BaseDAO", 0777);
			}
			if(fopen(filePathBaseDAO, 'w')){
				log_debug(get_class($this),"Create File [" . filePathBaseDAO . "] Success.");
			}else{
				log_debug(get_class($this),"Fail to create file.");
			}
			file_put_contents(filePathBaseDAO, $BaseDAO ,LOCK_EX);
			return $BaseDAO;
		}
		
		function VOFile($table_column,$table){
			$parts = explode('_', $table);
			foreach($parts as $s){
				$name .= ucfirst($s);
			}
			$VO .= 	"<?php\n"
					. "\tclass " . $name . "{\n"
					. "\t\tvar ";
			$count = 0;
			$len = count($table_column['COLUMN_NAME']);
			foreach($table_column['COLUMN_NAME'] as $s){
				if($count == 0){
					$VO .= "$" . $s . ",\n";
				}
				else if($count == $len - 1){
					$VO .= "\t\t\t$" . $s;
				}
				else{
					$VO .= "\t\t\t$" . $s . ",\n";
				}
				$count++;
			}
			$VO .=  ";\n"
					. "\t}\n"
					. "?>";
			
			if(!is_dir("gen/src/vo")){
				mkdir("gen/src/vo", 0777);
			}
			if(fopen(filePathVO, 'w')){
				log_debug(get_class($this),"Create File [" . filePathVO . "] Success.");
			}else{
				log_debug(get_class($this),"Fail to create file.");
			}
			file_put_contents(filePathVO, $VO ,LOCK_EX);
			return $VO;
		}
		
		function SavePath($table){
			$parts = explode('_', $table);
			foreach($parts as $s){
				$name .= ucfirst($s);
			}
			define( 'filePathDAO', 'gen/src/DAO/' . $name . 'DAO.class.php');
			define( 'filePathBaseDAO', 'gen/src/DAO/BaseDAO/' . $name . 'BaseDAO.class.php');
			define( 'filePathVO', 'gen/src/vo/' . $name . '.class.php');
			log_debug(get_class($this),filePathDAO);
			log_debug(get_class($this),filePathBaseDAO);
			log_debug(get_class($this),filePathVO);
		}
	}
?>