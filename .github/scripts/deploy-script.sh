#!/bin/bash

# Get required value
GITHUB_TOKEN=${GITHUB_TOKEN?Need a value}
DEPLOY_KEY=${SERVER_AUTHORIZATION?Need a value}
DEPLOY_URL=${SERVER_URL?Need a value}

# Trigger Deployment Scripts On server
response=($(curl -X POST -d "token=${GITHUB_TOKEN}&type=${1}" -H "Authorization:${DEPLOY_KEY}" -w "\n%{http_code}" ${DEPLOY_URL}))
body=${response[@]::${#response[@]}-1}
code=${response[-1]}

echo $body

if [ $code -ne 200 ]; then
    exit 20
fi