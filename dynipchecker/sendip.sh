#!/bin/bash

#config section
TOKEN=secret_key
URL="http://your_website.com/ip/"
#end of config section

IP=`curl $URL?show`
HOST=`hostname`
curl -d "ip=$IP&host=$HOST"  -H "Authorization: $TOKEN" $URL

