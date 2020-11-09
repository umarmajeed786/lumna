<?php
$servername = "localhost";
$username = "feibisco_tatu";
$password = "mabati2020";
$dbname = "feibisco_lansapi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$urls = array(
    "https://item.taobao.com/item.htm?id=626097433535"
    ,"https://item.taobao.com/item.htm?id=626110853687"
    ,"https://item.taobao.com/item.htm?id=626113593635"
    ,"https://item.taobao.com/item.htm?id=626297438424"
    ,"https://item.taobao.com/item.htm?id=626297714380"
    ,"https://item.taobao.com/item.htm?id=626301994879"
    ,"https://item.taobao.com/item.htm?id=626302982916"
    ,"https://item.taobao.com/item.htm?id=626304046717"
    ,"https://item.taobao.com/item.htm?id=626304154331"
    ,"https://item.taobao.com/item.htm?id=626304206887"
    ,"https://item.taobao.com/item.htm?id=626387998975"
    ,"https://item.taobao.com/item.htm?id=626404162416"
    ,"https://item.taobao.com/item.htm?id=626587023915"
    ,"https://item.taobao.com/item.htm?id=626591923106"
    ,"https://item.taobao.com/item.htm?id=626678103494"
    ,"https://item.taobao.com/item.htm?id=626678507778"
    ,"https://item.taobao.com/item.htm?id=626679239347"
    ,"https://item.taobao.com/item.htm?id=626690895202"
    ,"https://item.taobao.com/item.htm?id=626693511124"
    ,"https://item.taobao.com/item.htm?id=622207199589"
    ,"https://item.taobao.com/item.htm?id=621335147278"
    ,"https://item.taobao.com/item.htm?id=621183935211"
    ,"https://item.taobao.com/item.htm?id=623494046432"
    ,"https://item.taobao.com/item.htm?id=623211789104"
    ,"https://item.taobao.com/item.htm?id=620132344420"
    ,"https://item.taobao.com/item.htm?id=620133976223"
    ,"https://item.taobao.com/item.htm?id=620136164433"
    ,"https://item.taobao.com/item.htm?id=620142212582"
    ,"https://item.taobao.com/item.htm?id=620144888348"
    ,"https://item.taobao.com/item.htm?id=620146488088"
    ,"https://item.taobao.com/item.htm?id=620148432231"
    ,"https://item.taobao.com/item.htm?id=620273808440"
    ,"https://item.taobao.com/item.htm?id=620276576651"
    ,"https://item.taobao.com/item.htm?id=620285312750"
    ,"https://item.taobao.com/item.htm?id=620287880465"
    ,"https://item.taobao.com/item.htm?id=620288440158"
    ,"https://item.taobao.com/item.htm?id=620289052472"
    ,"https://item.taobao.com/item.htm?id=620293044385"
    ,"https://item.taobao.com/item.htm?id=620293704463"
    ,"https://item.taobao.com/item.htm?id=620296648657"
    ,"https://item.taobao.com/item.htm?id=620325624513"
    ,"https://item.taobao.com/item.htm?id=620332668279"
    ,"https://item.taobao.com/item.htm?id=620341920462"
    ,"https://item.taobao.com/item.htm?id=620345596799"
    ,"https://item.taobao.com/item.htm?id=620378468877"
    ,"https://item.taobao.com/item.htm?id=620379612954"
    ,"https://item.taobao.com/item.htm?id=620383988584"
    ,"https://item.taobao.com/item.htm?id=620384340613"
    ,"https://item.taobao.com/item.htm?id=620385612358"
    ,"https://item.taobao.com/item.htm?id=620390468591"
    ,"https://item.taobao.com/item.htm?id=620425113274"
    ,"https://item.taobao.com/item.htm?id=620428645218"
    ,"https://item.taobao.com/item.htm?id=620430629441"
    ,"https://item.taobao.com/item.htm?id=620434972502"
    ,"https://item.taobao.com/item.htm?id=620439040682"
    ,"https://item.taobao.com/item.htm?id=620440365239"
    ,"https://item.taobao.com/item.htm?id=620442144622"
    ,"https://item.taobao.com/item.htm?id=620444200528"
    ,"https://item.taobao.com/item.htm?id=620445736128"
    ,"https://item.taobao.com/item.htm?id=620446569268"
    ,"https://item.taobao.com/item.htm?id=620447312900"
    ,"https://item.taobao.com/item.htm?id=620447664044"
    ,"https://item.taobao.com/item.htm?id=620477696587"
    ,"https://item.taobao.com/item.htm?id=620488832812"
    ,"https://item.taobao.com/item.htm?id=620492252246"
    ,"https://item.taobao.com/item.htm?id=620495968307"
    ,"https://item.taobao.com/item.htm?id=620496848250"
    ,"https://item.taobao.com/item.htm?id=620544596363"
    ,"https://item.taobao.com/item.htm?id=620545656671"
    ,"https://item.taobao.com/item.htm?id=620548776668"
    ,"https://item.taobao.com/item.htm?id=620550660639"
    ,"https://item.taobao.com/item.htm?id=620575269378"
    ,"https://item.taobao.com/item.htm?id=620577793051"
    ,"https://item.taobao.com/item.htm?id=620584553751"
    ,"https://item.taobao.com/item.htm?id=620585837165"
    ,"https://item.taobao.com/item.htm?id=620589337687"
    ,"https://item.taobao.com/item.htm?id=620590173287"
    ,"https://item.taobao.com/item.htm?id=620624529217"
    ,"https://item.taobao.com/item.htm?id=620625645541"
    ,"https://item.taobao.com/item.htm?id=620627493958"
    ,"https://item.taobao.com/item.htm?id=620632157555"
    ,"https://item.taobao.com/item.htm?id=620636093466"
    ,"https://item.taobao.com/item.htm?id=620637289640"
    ,"https://item.taobao.com/item.htm?id=620639677276"
    ,"https://item.taobao.com/item.htm?id=620641929124"
    ,"https://item.taobao.com/item.htm?id=620645293506"
    ,"https://item.taobao.com/item.htm?id=620650236020"
    ,"https://item.taobao.com/item.htm?id=620678773130"
    ,"https://item.taobao.com/item.htm?id=620680833885"
    ,"https://item.taobao.com/item.htm?id=620682568148"
    ,"https://item.taobao.com/item.htm?id=620684757862"
    ,"https://item.taobao.com/item.htm?id=620690213373"
    ,"https://item.taobao.com/item.htm?id=620691573098"
    ,"https://item.taobao.com/item.htm?id=620707392075"
    ,"https://item.taobao.com/item.htm?id=620711114200"
    ,"https://item.taobao.com/item.htm?id=620737477455"
    ,"https://item.taobao.com/item.htm?id=620741329382"
    ,"https://item.taobao.com/item.htm?id=620742489144"
    ,"https://item.taobao.com/item.htm?id=620747441991"
    ,"https://item.taobao.com/item.htm?id=620778741933"
    ,"https://item.taobao.com/item.htm?id=620780929236"
    ,"https://item.taobao.com/item.htm?id=620782729675"
    ,"https://item.taobao.com/item.htm?id=620784617104"
    ,"https://item.taobao.com/item.htm?id=620789133427"
    ,"https://item.taobao.com/item.htm?id=620790553747"
    ,"https://item.taobao.com/item.htm?id=620842845878"
    ,"https://item.taobao.com/item.htm?id=620848225676"
    ,"https://item.taobao.com/item.htm?id=620849138200"
    ,"https://item.taobao.com/item.htm?id=620849225115"
    ,"https://item.taobao.com/item.htm?id=620849737810"
    ,"https://item.taobao.com/item.htm?id=620856346157"
    ,"https://item.taobao.com/item.htm?id=620859202288"
    ,"https://item.taobao.com/item.htm?id=620862554849"
    ,"https://item.taobao.com/item.htm?id=620901022079"
    ,"https://item.taobao.com/item.htm?id=620901098939"
    ,"https://item.taobao.com/item.htm?id=620902188589"
    ,"https://item.taobao.com/item.htm?id=620903342396"
    ,"https://item.taobao.com/item.htm?id=620904058034"
    ,"https://item.taobao.com/item.htm?id=620911946115"
    ,"https://item.taobao.com/item.htm?id=620912818394"
    ,"https://item.taobao.com/item.htm?id=620913630082"
    ,"https://item.taobao.com/item.htm?id=620919534102"
    ,"https://item.taobao.com/item.htm?id=620942404816"
    ,"https://item.taobao.com/item.htm?id=620942928519"
    ,"https://item.taobao.com/item.htm?id=620943636178"
    ,"https://item.taobao.com/item.htm?id=620943972194"
    ,"https://item.taobao.com/item.htm?id=620943996427"
    ,"https://item.taobao.com/item.htm?id=620951858283"
    ,"https://item.taobao.com/item.htm?id=620953110038"
    ,"https://item.taobao.com/item.htm?id=620954940101"
    ,"https://item.taobao.com/item.htm?id=620955024637"
    ,"https://item.taobao.com/item.htm?id=620963366059"
    ,"https://item.taobao.com/item.htm?id=620964135376"
    ,"https://item.taobao.com/item.htm?id=620970719412"
    ,"https://item.taobao.com/item.htm?id=620972643403"
    ,"https://item.taobao.com/item.htm?id=620974831306"
    ,"https://item.taobao.com/item.htm?id=621015334533"
    ,"https://item.taobao.com/item.htm?id=621015862746"
    ,"https://item.taobao.com/item.htm?id=621016038403"
    ,"https://item.taobao.com/item.htm?id=621017450645"
    ,"https://item.taobao.com/item.htm?id=621018922331"
    ,"https://item.taobao.com/item.htm?id=621022630342"
    ,"https://item.taobao.com/item.htm?id=621055176836"
    ,"https://item.taobao.com/item.htm?id=621057186979"
    ,"https://item.taobao.com/item.htm?id=621057656156"
    ,"https://item.taobao.com/item.htm?id=621061922898"
    ,"https://item.taobao.com/item.htm?id=621062654913"
    ,"https://item.taobao.com/item.htm?id=621063446140"
    ,"https://item.taobao.com/item.htm?id=621064714472"
    ,"https://item.taobao.com/item.htm?id=621066944864"
    ,"https://item.taobao.com/item.htm?id=621067688555"
    ,"https://item.taobao.com/item.htm?id=621070682900"
    ,"https://item.taobao.com/item.htm?id=621112471215"
    ,"https://item.taobao.com/item.htm?id=621117366962"
    ,"https://item.taobao.com/item.htm?id=621120218145"
    ,"https://item.taobao.com/item.htm?id=621125995154"
    ,"https://item.taobao.com/item.htm?id=621137775985"
    ,"https://item.taobao.com/item.htm?id=621163099567"
    ,"https://item.taobao.com/item.htm?id=621168315997"
    ,"https://item.taobao.com/item.htm?id=621168767837"
    ,"https://item.taobao.com/item.htm?id=621169319781"
    ,"https://item.taobao.com/item.htm?id=621176155515"
    ,"https://item.taobao.com/item.htm?id=621179807867"
    ,"https://item.taobao.com/item.htm?id=621185043972"
    ,"https://item.taobao.com/item.htm?id=621187527767"
    ,"https://item.taobao.com/item.htm?id=621217978041"
    ,"https://item.taobao.com/item.htm?id=621218914601"
    ,"https://item.taobao.com/item.htm?id=621221675663"
    ,"https://item.taobao.com/item.htm?id=621222397768"
    ,"https://item.taobao.com/item.htm?id=621227419984"
    ,"https://item.taobao.com/item.htm?id=621236226665"
    ,"https://item.taobao.com/item.htm?id=621255717789"
    ,"https://item.taobao.com/item.htm?id=621258342075"
    ,"https://item.taobao.com/item.htm?id=621277763941"
    ,"https://item.taobao.com/item.htm?id=621278246477"
    ,"https://item.taobao.com/item.htm?id=621284763125"
    ,"https://item.taobao.com/item.htm?id=621331099227"
    ,"https://item.taobao.com/item.htm?id=621335203122"
    ,"https://item.taobao.com/item.htm?id=621347312440"
    ,"https://item.taobao.com/item.htm?id=621351472825"
    ,"https://item.taobao.com/item.htm?id=621357372754"
    ,"https://item.taobao.com/item.htm?id=621357821690"
    ,"https://item.taobao.com/item.htm?id=621358612539"
    ,"https://item.taobao.com/item.htm?id=621359761741"
    ,"https://item.taobao.com/item.htm?id=621359813385"
    ,"https://item.taobao.com/item.htm?id=621381827143"
    ,"https://item.taobao.com/item.htm?id=621389663687"
    ,"https://item.taobao.com/item.htm?id=621390595887"
    ,"https://item.taobao.com/item.htm?id=621390663261"
    ,"https://item.taobao.com/item.htm?id=621451604667"
    ,"https://item.taobao.com/item.htm?id=621460236196"
    ,"https://item.taobao.com/item.htm?id=621468862007"
    ,"https://item.taobao.com/item.htm?id=621477619846"
    ,"https://item.taobao.com/item.htm?id=621490966855"
    ,"https://item.taobao.com/item.htm?id=621501502976"
    ,"https://item.taobao.com/item.htm?id=621507986851"
    ,"https://item.taobao.com/item.htm?id=621518694570"
    ,"https://item.taobao.com/item.htm?id=621519692930"
    ,"https://item.taobao.com/item.htm?id=621521259135"
    ,"https://item.taobao.com/item.htm?id=621521896306"
    ,"https://item.taobao.com/item.htm?id=621523228827"
    ,"https://item.taobao.com/item.htm?id=621537108275"
    ,"https://item.taobao.com/item.htm?id=621539160633"
    ,"https://item.taobao.com/item.htm?id=621540156996"
    ,"https://item.taobao.com/item.htm?id=621544152667"
    ,"https://item.taobao.com/item.htm?id=621547411445"
    ,"https://item.taobao.com/item.htm?id=621550248544"
    ,"https://item.taobao.com/item.htm?id=621550576712"
    ,"https://item.taobao.com/item.htm?id=621596000186"
    ,"https://item.taobao.com/item.htm?id=621632346935"
    ,"https://item.taobao.com/item.htm?id=621633962996"
    ,"https://item.taobao.com/item.htm?id=621636406431"
    ,"https://item.taobao.com/item.htm?id=621644957849"
    ,"https://item.taobao.com/item.htm?id=621650485073"
    ,"https://item.taobao.com/item.htm?id=621661461810"
    ,"https://item.taobao.com/item.htm?id=621665412034"
    ,"https://item.taobao.com/item.htm?id=621688837393"
    ,"https://item.taobao.com/item.htm?id=621741499093"
    ,"https://item.taobao.com/item.htm?id=621742531933"
    ,"https://item.taobao.com/item.htm?id=621744423340"
    ,"https://item.taobao.com/item.htm?id=621755955154"
    ,"https://item.taobao.com/item.htm?id=621766573327"
    ,"https://item.taobao.com/item.htm?id=621767229819"
    ,"https://item.taobao.com/item.htm?id=621775903025"
    ,"https://item.taobao.com/item.htm?id=621821661236"
    ,"https://item.taobao.com/item.htm?id=621822981219"
    ,"https://item.taobao.com/item.htm?id=621826657193"
    ,"https://item.taobao.com/item.htm?id=621839953579"
    ,"https://item.taobao.com/item.htm?id=621841981286"
    ,"https://item.taobao.com/item.htm?id=621845241075"
    ,"https://item.taobao.com/item.htm?id=621848273646"
    ,"https://item.taobao.com/item.htm?id=621898233768"
    ,"https://item.taobao.com/item.htm?id=621930374893"
    ,"https://item.taobao.com/item.htm?id=621933582877"
    ,"https://item.taobao.com/item.htm?id=621935326123"
    ,"https://item.taobao.com/item.htm?id=621937766467"
    ,"https://item.taobao.com/item.htm?id=621938594345"
    ,"https://item.taobao.com/item.htm?id=621939574387"
    ,"https://item.taobao.com/item.htm?id=621966777515"
    ,"https://item.taobao.com/item.htm?id=622027090272"
    ,"https://item.taobao.com/item.htm?id=622039810334"
    ,"https://item.taobao.com/item.htm?id=622042354300"
    ,"https://item.taobao.com/item.htm?id=622042822587"
    ,"https://item.taobao.com/item.htm?id=622043314746"
    ,"https://item.taobao.com/item.htm?id=622045146789"
    ,"https://item.taobao.com/item.htm?id=622095790924"
    ,"https://item.taobao.com/item.htm?id=622118218829"
    ,"https://item.taobao.com/item.htm?id=622127846782"
    ,"https://item.taobao.com/item.htm?id=622175766567"
    ,"https://item.taobao.com/item.htm?id=622199463171"
    ,"https://item.taobao.com/item.htm?id=622203003276"
    ,"https://item.taobao.com/item.htm?id=622205271371"
    ,"https://item.taobao.com/item.htm?id=622207843111"
    ,"https://item.taobao.com/item.htm?id=622234007461"
    ,"https://item.taobao.com/item.htm?id=622289155636"
    ,"https://item.taobao.com/item.htm?id=622294255146"
    ,"https://item.taobao.com/item.htm?id=622307351277"
    ,"https://item.taobao.com/item.htm?id=622310899886"
    ,"https://item.taobao.com/item.htm?id=622313283256"
    ,"https://item.taobao.com/item.htm?id=622313799912"
    ,"https://item.taobao.com/item.htm?id=622390075618"
    ,"https://item.taobao.com/item.htm?id=622402963057"
    ,"https://item.taobao.com/item.htm?id=622517067652"
    ,"https://item.taobao.com/item.htm?id=622793888448"
    ,"https://item.taobao.com/item.htm?id=623098553848"
    ,"https://item.taobao.com/item.htm?id=623100921687"
    ,"https://item.taobao.com/item.htm?id=623101229803"
    ,"https://item.taobao.com/item.htm?id=623105629125"
    ,"https://item.taobao.com/item.htm?id=623127992502"
    ,"https://item.taobao.com/item.htm?id=623135320126"
    ,"https://item.taobao.com/item.htm?id=623135320126"
    ,"https://item.taobao.com/item.htm?id=623136256663"
    ,"https://item.taobao.com/item.htm?id=623184948388"
    ,"https://item.taobao.com/item.htm?id=623209629941"
    ,"https://item.taobao.com/item.htm?id=623211369924"
    ,"https://item.taobao.com/item.htm?id=623212829596"
    ,"https://item.taobao.com/item.htm?id=623230241410"
    ,"https://item.taobao.com/item.htm?id=623378914438"
    ,"https://item.taobao.com/item.htm?id=623489566484"
    ,"https://item.taobao.com/item.htm?id=623490614871"
    ,"https://item.taobao.com/item.htm?id=623491358863"
    ,"https://item.taobao.com/item.htm?id=623492194264"
    ,"https://item.taobao.com/item.htm?id=623492262500"
    ,"https://item.taobao.com/item.htm?id=623493206750"
    ,"https://item.taobao.com/item.htm?id=623493634736"
    ,"https://item.taobao.com/item.htm?id=622178318368"
    ,"https://item.taobao.com/item.htm?id=622195007529"
    ,"https://item.taobao.com/item.htm?id=622195031942"
    ,"https://item.taobao.com/item.htm?id=622195671765"
    ,"https://item.taobao.com/item.htm?id=622198195593"
    ,"https://item.taobao.com/item.htm?id=622198627955"
    ,"https://item.taobao.com/item.htm?id=622206783768"
    ,"https://item.taobao.com/item.htm?id=622207503734"
    ,"https://item.taobao.com/item.htm?id=622207763001"
    ,"https://item.taobao.com/item.htm?id=622248206014"
    ,"https://item.taobao.com/item.htm?id=622351739141"
    ,"https://item.taobao.com/item.htm?id=622352643521"
    ,"https://item.taobao.com/item.htm?id=622370395247"
    ,"https://item.taobao.com/item.htm?id=622373903873"
    ,"https://item.taobao.com/item.htm?id=622390407753"
    ,"https://item.taobao.com/item.htm?id=622391759472"
    ,"https://item.taobao.com/item.htm?id=622392543670"
    ,"https://item.taobao.com/item.htm?id=622395899134"
    ,"https://item.taobao.com/item.htm?id=622397187833"
    ,"https://item.taobao.com/item.htm?id=622398663171"
    ,"https://item.taobao.com/item.htm?id=622398883854"
    ,"https://item.taobao.com/item.htm?id=622401747042"
    ,"https://item.taobao.com/item.htm?id=622401883502"
    ,"https://item.taobao.com/item.htm?id=622438735230"
    ,"https://item.taobao.com/item.htm?id=622445331634"
    ,"https://item.taobao.com/item.htm?id=622447451335"
    ,"https://item.taobao.com/item.htm?id=622516555665"
    ,"https://item.taobao.com/item.htm?id=622796160399"
    ,"https://item.taobao.com/item.htm?id=622800460854"
    ,"https://item.taobao.com/item.htm?id=622909828190"
    ,"https://item.taobao.com/item.htm?id=623097933651"
    ,"https://item.taobao.com/item.htm?id=623099453536"
    ,"https://item.taobao.com/item.htm?id=623100933254"
    ,"https://item.taobao.com/item.htm?id=623101213064"
    ,"https://item.taobao.com/item.htm?id=623104449725"
    ,"https://item.taobao.com/item.htm?id=623104845772"
    ,"https://item.taobao.com/item.htm?id=623125684940"
    ,"https://item.taobao.com/item.htm?id=623127228429"
    ,"https://item.taobao.com/item.htm?id=623228753363"
    ,"https://item.taobao.com/item.htm?id=623232001080"
    ,"https://item.taobao.com/item.htm?id=623232209247"
    ,"https://item.taobao.com/item.htm?id=623232573405"
    ,"https://item.taobao.com/item.htm?id=623377366933"
    ,"https://item.taobao.com/item.htm?id=623378226781"
    ,"https://item.taobao.com/item.htm?id=623379042909"
    ,"https://item.taobao.com/item.htm?id=623384814620"
    ,"https://item.taobao.com/item.htm?id=623385058846"
    ,"https://item.taobao.com/item.htm?id=623429513281"
    ,"https://item.taobao.com/item.htm?id=623430785723"
    ,"https://item.taobao.com/item.htm?id=623437181184"
    ,"https://item.taobao.com/item.htm?id=623655031031"
    ,"https://item.taobao.com/item.htm?id=623659363202"
    ,"https://item.taobao.com/item.htm?id=623662387527"
    ,"https://item.taobao.com/item.htm?id=623663471495"
    ,"https://item.taobao.com/item.htm?id=623663779627"
    ,"https://item.taobao.com/item.htm?id=623710126466"
    ,"https://item.taobao.com/item.htm?id=623711122051"
    ,"https://item.taobao.com/item.htm?id=623711790026"
    ,"https://item.taobao.com/item.htm?id=623712986344"
    ,"https://item.taobao.com/item.htm?id=623713278894"
    ,"https://item.taobao.com/item.htm?id=623713914815"
    ,"https://item.taobao.com/item.htm?id=623714990426"
    ,"https://item.taobao.com/item.htm?id=623718130055"
    ,"https://item.taobao.com/item.htm?id=623728031811"
    ,"https://item.taobao.com/item.htm?id=623741658701"
    ,"https://item.taobao.com/item.htm?id=623767427637"
    ,"https://item.taobao.com/item.htm?id=623769447959"
    ,"https://item.taobao.com/item.htm?id=623771771694"
    ,"https://item.taobao.com/item.htm?id=623787347592"
    ,"https://item.taobao.com/item.htm?id=623788819940"
    ,"https://item.taobao.com/item.htm?id=623991191620"
    ,"https://item.taobao.com/item.htm?id=623992235150"
    ,"https://item.taobao.com/item.htm?id=623994195351"
    ,"https://item.taobao.com/item.htm?id=623994743903"
    ,"https://item.taobao.com/item.htm?id=623998867438"
    ,"https://item.taobao.com/item.htm?id=625689852006"
    ,"https://item.taobao.com/item.htm?id=625779060333"
    ,"https://item.taobao.com/item.htm?id=625780768754"
    ,"https://item.taobao.com/item.htm?id=625793452297"
    ,"https://item.taobao.com/item.htm?id=626004917218"
    ,"https://item.taobao.com/item.htm?id=626010561504"
    ,"https://item.taobao.com/item.htm?id=626011217460"

);


foreach($urls as $r){
   $data= explode("=",$r);
   $id=$data[1];

   $url = "https://www.lovbuy.com/taobaoapi/getproductinfo.php?key=a08d43d93db684b119f39ef5ae511656&item_id=$id&lang=en";

   $result = json_decode(file_get_contents($url),true);
//   echo "<pre>";
//   print_r($result);
//   print_r(array_keys($result['productinfo']));

//    $sqlData = "";
//    foreach ($result['productinfo'] as $key => $value) {
//
//        $sqlData .=",'$value'";
//    }
    if(!isset($result['productinfo'])){
        continue;
    }
  $fields = implode(",",array_keys($result['productinfo']));


    $query = "INSERT INTO products_tbl (num_iid,product_id,title,desc_short,price,total_price,
suggestive_price,orginal_price,nick,num,min_num,detail_url,
pic_url,brand,brandId,rootCatId,cid,crumbs,created_time,
modified_time,delist_time,`desc`,desc_img,item_imgs,item_weight,
item_size,location,post_fee,express_fee,ems_fee,shipping_to,
has_discount,video,is_virtual,sample_id,is_promotion,props_name,
prop_imgs,property_alias,props,total_sold,skus,seller_id,sales,shop_id,
props_list,seller_info,tmall,error,warning,url_log,favcount,fanscount,
stuff_status,shopinfo,data_from,method,promo_type,props_img,rate_grade,
shop_item,relate_items)
  VALUES(
  '" . $result['productinfo']['num_iid'] . "',
  '" . $result['productinfo']['num_iid'] . "',
  '" . $result['productinfo']['title'] . "',
  '" . $result['productinfo']['desc_short'] . "',
  '" . $result['productinfo']['price'] . "',
  '" . $result['productinfo']['total_price'] . "',
  '" . $result['productinfo']['suggestive_price'] . "',
  '" . $result['productinfo']['orginal_price'] . "',
  '" . $result['productinfo']['nick'] . "',
  '" . $result['productinfo']['num'] . "',
  '" . $result['productinfo']['min_num'] . "',
  '" . $result['productinfo']['detail_url'] . "',
  '" . $result['productinfo']['pic_url'] . "',
  '" . $result['productinfo']['brand'] . "',
  '" . $result['productinfo']['brandId'] . "',
  '" . $result['productinfo']['rootCatId'] . "',
  '" . $result['productinfo']['cid'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['crumbs'])) . "',
  '" . $result['productinfo']['created_time'] . "',
  '" . $result['productinfo']['modified_time'] . "',
  '" . $result['productinfo']['delist_time'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['desc'])) . "',
  '" . json_encode($result['productinfo']['desc_img']) . "',
  '" . json_encode($result['productinfo']['item_imgs']) . "',
  '" . $result['productinfo']['item_weight'] . "',
  '" . $result['productinfo']['item_size'] . "',
  '" . $result['productinfo']['location'] . "',
  '" . $result['productinfo']['post_fee'] . "',
  '" . $result['productinfo']['express_fee'] . "',
  '" . $result['productinfo']['ems_fee'] . "',
  '" . $result['productinfo']['shipping_to'] . "',
  '" . $result['productinfo']['has_discount'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['video'])) . "',
  '" . $result['productinfo']['is_virtual'] . "',
  '" . $result['productinfo']['sample_id'] . "',
  '" . $result['productinfo']['is_promotion'] . "',
  '" . $result['productinfo']['props_name'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['prop_imgs'])) . "',
  '" . $result['productinfo']['property_alias'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['props'])) . "',
  '" . $result['productinfo']['total_sold'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['skus'])) . "',
  '" . $result['productinfo']['seller_id'] . "',
  '" . $result['productinfo']['sales'] . "',
  '" . $result['productinfo']['shop_id'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['props_list'])) . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['seller_info'])) . "',
  '" . $result['productinfo']['tmall'] . "',
  '" . $result['productinfo']['error'] . "',
  '" . $result['productinfo']['warning'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['url_log'])) . "',
  '" . $result['productinfo']['favcount'] . "',
  '" . $result['productinfo']['fanscount'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['stuff_status'])) . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['shopinfo'])) . "',
  '" . $result['productinfo']['data_from'] . "',
  '" . $result['productinfo']['method'] . "',
  '" . $result['productinfo']['promo_type'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['props_img'])) . "',
  '" . $result['productinfo']['rate_grade'] . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['shop_item'])) . "',
  '" . mysqli_real_escape_string($conn,json_encode($result['productinfo']['relate_items'])) . "'  
  )";

$rd= mysqli_query($conn,$query);
if($rd) {
    echo 'Successfull'.'<br>';
}

}

$conn->close();
?>
