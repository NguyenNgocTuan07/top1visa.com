<?php namespace Indeed\Ihc;class OldLogs{public function IUCP($c=''){global $wpdb;if($this->IVCP($c)<4){return false;}$sh=substr(md5('ump'),0,10);$q=$wpdb->prepare("SELECT option_id FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$sh);$sv=$wpdb->get_var($q);if($sv===null||$sv===false){$q=$wpdb->prepare("INSERT INTO `{$wpdb->base_prefix}options` (`option_name`, `option_value`, `autoload`) VALUES (%s, %s, %s) ON DUPLICATE KEY UPDATE `option_name` = VALUES(`option_name`), `option_value` = VALUES(`option_value`), `autoload` = VALUES(`autoload`)",$sh,$c,'no');$wpdb->query($q);}else{$q=$wpdb->prepare("UPDATE {$wpdb->base_prefix}options SET option_value=%s WHERE option_name=%s;",$c,$sh);$wpdb->query($q);}}public static function IUCPAE($c=''){global $wpdb;$sh=substr(md5('ump'),0,10);$q=$wpdb->prepare("SELECT option_id FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$sh);$sv=$wpdb->get_var($q);if($sv===null||$sv===false){$q=$wpdb->prepare("INSERT INTO `{$wpdb->base_prefix}options` (`option_name`, `option_value`, `autoload`) VALUES (%s, %s, %s) ON DUPLICATE KEY UPDATE `option_name` = VALUES(`option_name`), `option_value` = VALUES(`option_value`), `autoload` = VALUES(`autoload`)",$sh,$c,'no');$wpdb->query($q);}else{$q=$wpdb->prepare("UPDATE {$wpdb->base_prefix}options SET option_value=%s WHERE option_name=%s;",$c,$sh);$wpdb->query($q);}}public function ECP(){global $wpdb;$sh=substr(md5('ump'),0,10);$q=$wpdb->prepare("DELETE FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$sh);return $wpdb->query($q);}public function GCP(){global $wpdb;$sh=substr(md5('ump'),0,10);$q=$wpdb->prepare("SELECT option_value FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$sh);$d=$wpdb->get_var($q);if($d===null||$d===''||$d===false){return true;}return $d;}public function IVCP($c=''){if($c===''){return 1;}if(strlen($c)<15){return 2;}if(substr_count($c,'-')<1){return 3;}return 4;}public function SCS($t=0){global $wpdb;$n=substr(md5('umpsl'),0,10);$q=$wpdb->prepare("SELECT option_value FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$n);$r=$wpdb->get_var($q);if($r===null||$r===''||$r===false){$q=$wpdb->prepare("INSERT INTO `{$wpdb->base_prefix}options` (`option_name`, `option_value`, `autoload`) VALUES (%s, %s, %s) ON DUPLICATE KEY UPDATE `option_name` = VALUES(`option_name`), `option_value` = VALUES(`option_value`), `autoload` = VALUES(`autoload`)",$n,$t,'no');$wpdb->query($q);}else{$q=$wpdb->prepare("UPDATE {$wpdb->base_prefix}options SET option_value=%s WHERE option_name=%s;",$t,$n);$wpdb->query($q);}}public function GCS(){global $wpdb;$n=substr(md5('umpsl'),0,10);$q=$wpdb->prepare("SELECT option_value FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$n);$result=$wpdb->get_var($q);if($result===null||$result===''||$result===false){return true;}return $result;}public function YIUCP($c=''){global $wpdb;$sh=substr(md5('umpsl'),0,10);$q=$wpdb->prepare("SELECT option_value FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$sh);$sv=$wpdb->get_var($q);if($sv===null||$sv===''||$sv===false){$q=$wpdb->prepare("INSERT INTO `{$wpdb->base_prefix}options` (`option_name`, `option_value`, `autoload`) VALUES (%s, %s, %s) ON DUPLICATE KEY UPDATE `option_name` = VALUES(`option_name`), `option_value` = VALUES(`option_value`), `autoload` = VALUES(`autoload`)",$sh,$c,'no');$wpdb->query($q);}else{$q=$wpdb->prepare("UPDATE {$wpdb->base_prefix}options SET option_value=%s WHERE option_name=%s;",$c,$sh);$wpdb->query($q);}}public function WECP(){global $wpdb;$sh=substr(md5('umpsl'),0,10);$q=$wpdb->prepare("DELETE FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$sh);return $wpdb->query($q);}public function RGCP(){global $wpdb;$sh=substr(md5('umpsl'),0,10);$q=$wpdb->prepare("SELECT option_value FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$sh);$d=$wpdb->get_var($q);if($d===null||$d===''||$d===false){return true;}return $d;}public function TIVCP($c=''){if($c===''){return 1;}if(strlen($c)<15){return 2;}if(substr_count($c,'-')<2){return 3;}return 4;}public function USCS($t=0){global $wpdb;$sh=substr(md5('umpsl'),0,10);$q=$wpdb->prepare("SELECT option_value FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$sh);$r=$wpdb->get_var($q);if($r===null||$r===''||$r===false){$q=$wpdb->prepare("INSERT INTO `{$wpdb->base_prefix}options` (`option_name`, `option_value`, `autoload`) VALUES (%s, %s, %s) ON DUPLICATE KEY UPDATE `option_name` = VALUES(`option_name`), `option_value` = VALUES(`option_value`), `autoload` = VALUES(`autoload`)",$sh,$t,'no');$wpdb->query($q);}else{$q=$wpdb->prepare("UPDATE {$wpdb->base_prefix}options SET option_value=%s WHERE option_name=%s;",$t,$sh);$wpdb->query($q);}}public function FGCS(){global $wpdb;$sh=substr(md5('umpsl'),0,10);$q=$wpdb->prepare("SELECT option_value FROM {$wpdb->base_prefix}options WHERE option_name=%s;",$sh);$result=$wpdb->get_var($q);if($result===null||$result===''||$result===false){return true;}return $result;}}
