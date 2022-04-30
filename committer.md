name: Auto commit

on:

  push:
    branches:
      - master
      
  schedule:
  - cron: "*/10 * * * *"

jobs:
  auto_commit:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2      
        with:
         persist-credentials: false
         fetch-depth: 0

      - name: Modify last update
        run: |
          d=`date '+%Y-%m-%dT%H:%M:%SZ'`
          echo $d > LAST_UPDATED
          
      - name: Commit changes
        run: |
          git config --local user.email "mike@mikeowino.com"
          git config --local user.name "mikeyhodl"
          git add -A
          
          arr[0]="ideal-meme"
          arr[1]="ideal-meme"
          arr[2]="ideal-meme"
          arr[3]="ideal-meme"
          arr[4]="ideal-meme"
          arr[5]="ideal-meme"
          arr[6]="ideal-meme"
          arr[7]="ideal-meme"
          
          rand=$[$RANDOM % ${#arr[@]}]
          
          git commit -m "${arr[$rand]}"
          
      - name: GitHub Push
        uses: ad-m/github-push-action@v0.5.0
        with:
          force: true
          directory: "."
          github_token: ${{ secrets.GITHUB_TOKEN }}
