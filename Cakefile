{print} = require 'sys'
{spawn} = require 'child_process'

SCRIPTS = ['public/script.coffee', 'public/html.coffee']

task 'build', 'Compile the CoffeeScript into JavaScript', ->
  coffee = spawn 'coffee', ['--compile'].concat(SCRIPTS)

  coffee.stderr.on 'data', (data) -> process.stderr.write data.toString()
  coffee.stdout.on 'data', (data) -> print data.toString()

task 'watch', 'Watch the CoffeeScript files for changes', ->
  coffee = spawn 'coffee', ['--compile', '--watch'].concat(SCRIPTS)

  coffee.stderr.on 'data', (data) -> process.stderr.write data.toString()
  coffee.stdout.on 'data', (data) -> print data.toString()
