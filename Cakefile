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
    ugly("#{script}.js")

ugly = (script) ->
  tmp = "#{script}.tmp"
  map = "#{script}.map"
  exec 'uglifyjs', ["-c", "-o", tmp, "--source-map", map, script], ->
    exec 'mv', [tmp, script]

SCRIPTS = ['public/script', 'public/html']

task 'build', 'Compile the CoffeeScript into JavaScript', ->
  coffee(script) for script in SCRIPTS

task 'watch', 'Watch the CoffeeScript files for changes', ->
  coffee_scripts = ("#{script}.coffee" for script in SCRIPTS)
  exec 'coffee', ['--compile', '--watch'].concat(coffee_scripts)

task 'clean', 'Delete compiled js', ->
  for script in SCRIPTS
    exec 'rm', ["-f", "#{script}.js", "#{script}.js.map"]