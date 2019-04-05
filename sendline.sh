export http_proxy=http://v1a-inf-fwp-01.dev.dtnaws.co.th:8080
export https_proxy=http://v1a-inf-fwp-01.dev.dtnaws.co.th:8080
export no_proxy=localhost,127.0.0.1,10.1.0.0/16,.dev.dtnaws.co.th

branch=$1
ver=$2
who=$3

curl -X POST https://notify-api.line.me/api/notify \
       -H 'Authorization: Bearer adbMDPBP4Q9Y9sMy5Iv4e9asnkglBf276qArv8j3pxt' \
       -F "message=Web Result on $branch version $ver by $who" \
       -F 'imageFile=@robot_result/selenium-screenshot-1.png'


curl -X POST https://notify-api.line.me/api/notify \
       -H 'Authorization: Bearer adbMDPBP4Q9Y9sMy5Iv4e9asnkglBf276qArv8j3pxt' \
       -F 'message=Web Result' \
       -F 'imageFile=@robot_result/selenium-screenshot-2.png' || true


reciept="woravitp@dtac.co.th,chookiat.somwangsombat@dtac.co.th,siyakorn.lengthanom@dtac.co.th,OSKumpawa@dtac.co.th,supakron.se@marginframe.com"
subject="Result Deploy OCC on $branch , Image Number $ver , by $who"

img1="/usr/home/WEBADM/occmnpwd/Script/testscript/checkweb/robot_result/selenium-screenshot-1.png"

img2="/usr/home/WEBADM/occmnpwd/Script/testscript/checkweb/robot_result/selenium-screenshot-2.png"

#echo "Please see result in attachment" | mailx -r "onlinestore@dtac.co.th" -s "$subject"  $reciept -A $img1 -A $img2
