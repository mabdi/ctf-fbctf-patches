<?hh // strict

class ExtraUtils {
  private function __construct() {}

  private function __clone(): void {}

  public static async function getFolderName($level_id, $team_id): Awaitable<string> {
        $my_team = await Team::genTeam((int)$team_id);
        $my_level = await Level::gen($level_id);
//file_put_contents( '/tmp/3.log', var_export( $my_team->getId() ,true),FILE_APPEND);
//file_put_contents( '/tmp/3.log', var_export( $my_level->getSecret() ,true),FILE_APPEND);
        return md5( $my_level->getSecret().$my_team->getId());
  }

  public static function CallAPI($method, $url, $data = false): string
  {
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_PROXY, '');
//curl_setopt($curl, CURLOPT_SSLVERSION,'all'); 

    $result = curl_exec($curl);
if($result == false){

   file_put_contents( '/tmp/3.log', var_export(curl_error($curl)   ,true),FILE_APPEND);

}
    curl_close($curl);

    return $result;
  }

}
