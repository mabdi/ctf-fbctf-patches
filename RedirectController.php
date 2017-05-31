<?hh // strict

//SessionUtils::sessionStart();
//SessionUtils::enforceLogin();
class RedirectController extends Controller {
  <<__Override>>
  protected function getTitle(): string {
    return 'مسابقه فتح پرچم بهسازان';
  }

  <<__Override>>
  protected function getFilters(): array<string, mixed> {
    return array();
  }

  <<__Override>>
  protected function getPages(): array<string> {
    return array();
  }

  <<__Override>>
  public async function genRenderBody(string $page): Awaitable<:xhp> {

        $q_id = (int)idx(Utils::getGET(), 'q');
        $my_level = await Level::gen($q_id);
        $randx = await Utils::getFolderName($q_id,SessionUtils::sessionTeam());

$data = array(
	'team'=>SessionUtils::sessionTeam(),
	'pid'=> md5( "salt12345" .$my_level->getSecret()),
	'folder'=>$randx,
	'access_token'=>'8e39a85022b8c194cb7cc3f7ae3e0217');

$result = Utils::CallAPI("POST","https://ctf.behsazan.net/api/init",$data);
file_put_contents( '/tmp/3.log', var_export($result,true),FILE_APPEND);

$result = json_decode($result);
//file_put_contents( '/tmp/3.log', var_export($result,true),FILE_APPEND);

if($result->{'stat'} == 1){
   $data = $result->{'data'};
   throw new RedirectException($data->{'redirect_to'},302);
}else{
   throw new InternalErrorRedirectException();
}

    throw new InternalErrorRedirectException();
    return
      <body data-section="pages">
        <div class="fb-sprite" id="fb-svg-sprite"></div>
        <div class="fb-viewport" lang="fa">

          <div id="fb-main-nav"></div>
          <div id="fb-main-content" class="fb-page">
		<ul>

		</ul></div>
	        </div>
        <script type="text/javascript" src="static/dist/js/app.js"></script>
      </body>;
  }
}
