# Laravel-UrlShortener

This is a Url Shortening API.

<strong>Application Setup 1 (php artisan serve):</strong>
<ol>
    <li>In your terminal, navigate to an empty folder</li>
    <li>Clone into the repository by running this command: git clone https://github.com/oti215/Laravel-UrlShortener.git</li>
    <li>Navigate into the cloned repository</li>
    <li>Run the following command: php artisan serve</li>
    <li>The app will now be running at http://localhost:8000</li>
</ol>

<strong>Database Setup:</strong>
<ol>
    <li>You may set up the application's database in the server of your choosing</li>
    <li>
        Be sure to include your database connection information in the .env file
        <ul>
            <li>DB_CONNECTION=mysql</li>
            <li>DB_HOST=127.0.0.1</li>
            <li>DB_PORT=3306</li>
            <li>DB_DATABASE=homestead</li>
            <li>DB_USERNAME=root</li>
            <li>DB_PASSWORD=root</li>
        </ul>
    </li>
    <li>Remember to create the database with the same name as specified in the .env file</li>
    <li>Once you have that set up, just run: php artisan migrate</li>
</ol>

The API has the following endpoints which may be used without authentication:
<ol>
    <li>
        Create Short Url
        <ul>
            <li>Type: POST</li>
            <li>Path: /api/url/create_short_url </li>
            <li>Form Body: { url: 'valid url string' } </li>
            <li>Description: This endpoint will create a 6 character hash (using <a href="https://hashids.org/php/">Hashids PHP library</a>) to represent the passed url, it will then append this hash to the API's URL, thus forming a unique short url. You can change the APP_URL variable in the .env.</li>
        </ul>
    </li>
    <li>
        Get Top Visited Urls
        <ul>
            <li>Type: GET</li>
            <li>Path: /api/url/get_most_visited/{rows?} </li>
            <li><strong>Optional</strong> Query Param: # of rows desired. If ommited, will default to 100 as per requirement.</li>
        </ul>
    </li> 
    <li>
        Visit Short Url (redirect to long url)
        <ul>
            <li>Type: GET</li>
            <li>Path: /{hash} </li>
            <li>Description: This will redirect the user to the stored url for the given hash and increment the amount of visits for this specific short url</li>
        </ul>
    </li>
</ol>
