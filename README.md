# Installation 
1. download the project
2. cd to the downloaded file
3. run: docker compose up -d (docker should be installed on your system)
4. open in the browser `localhost:8000` for the home page
5. you can then request amazon information by using the 
   - `localhost:8000/amazon?url={amazonURL}`


Only Get requests are supported otherwise an error json will be returned.