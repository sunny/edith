{print} = require 'sys'
{spawn} = require 'child_process'

exec = (name, args, callback) ->
  p = spawn(name, args)
  p.stderr.on 'data', (data) ->
    process.stderr.write data.toString()
  p.stdout.on 'data', (data) ->
    print data.toString()
  p.on 'close', (code) ->
    callback() if code == 0 and callback

coffee = (script) ->
  exec 'coffee', ['--compile', "#{script}.coffee"], ->
    ugly(script)

ugly = (script) ->
  tmp = "#{script}.min.js"
  map = "#{script}.map.js"
  min = "#{script}.js"
  exec 'uglifyjs', ["-c", "-o", tmp, "--source-map", map, min], ->
    exec 'mv', [tmp, min]

SCRIPTS = ['public/script', 'public/html']

task 'build', 'Compile the CoffeeScript into JavaScript', ->
  coffee(script) for script in SCRIPTS

task 'watch', 'Watch the CoffeeScript files for changes', ->
  coffee_scripts = ("#{script}.coffee" for script in SCRIPTS)
  exec 'coffee', ['--compile', '--watch'].concat(coffee_scripts)

task 'clean', 'Delete compiled js', ->
  for script in SCRIPTS
    exec 'rm', ["#{script}.js", "#{script}.map.js"]
