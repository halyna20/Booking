<h1 align="center">Several Nights Booking System</h1>
<p>The Several Nights  is a simple apartment booking system that will allow you to find accommodation in any city</p>
<hr />

<h1>Instalation</h1>
<h3>Step 1: Install the Dependencies</h3>
<p>1) Instal the <a href="https://docs.docker.com/engine/install/ubuntu/">Docker for Linux</a> or <a href="https://docs.docker.com/desktop/install/windows-install/">Docker for Windows</a> and <a href="https://docs.docker.com/compose/install/">Docker Compose</a><p>
<p>2) Install <a href="https://nodejs.org/uk/download/">Node.js</a></p>
<p>3) Next install the <a href="https://getcomposer.org/doc/00-intro.md">Composer</a></p>
<h3>Step 2: Get Project</h3>
<p>1) Create a directory where you want to use this Docker project.</p>
<p>2) Go to the created folder and clone the repository</p>
<h3>Step 3: Change Docker config.</h3>
<p>Change the docker-compose / dockerfile (update network name, ports, etc)</p>
<p>Create <b>mysql</b> folder</p>
<h3>Step 4: Start Docker</h3>
<p>Run <b>docker-compose up -d --build</b></p>
<h3>Step 5: Сonnection to DB </h3>
<p>Copy <b>.env.example</b> file to <b>.env</b> and edit database credentials there</p>
<h3>Step 6: Install of the framework's dependencies</h3>
<p>Run <b>composer install</b></p>
<h3>Step 7: Migration</h3>
<p>Run <b>php artisan key:generate</b></p>
<p>Run <b>php artisan migrate --seed</b> (it has some seeded data for your testing)</p>
<h3>Step 8: Compile the files</h3>
<p>Run <b>npm install && npm run dev</b></p>
<h3>Step 9: Config file</h3>
<p>Go to <b>/src/resources/js/config.js</b> and update network name </p>
