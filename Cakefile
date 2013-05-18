fs = require 'fs'

{print} = require 'sys'
{spawn} = require 'child_process'


task 'build', 'Compile the CoffeeScript into JavaScript', ->
  coffee = spawn 'coffee', ['--compile', 'public/script.coffee', 'public/html.coffee']
  coffee.stderr.on 'data', (data) ->
    process.stderr.write data.toString()
  coffee.stdout.on 'data', (data) ->
    print data.toString()

task 'watch', 'Watch the CoffeeScript files for changes', ->
  coffee = spawn 'coffee', ['--compile', '--watch', 'public/script.coffee', 'public/html.coffee']
  coffee.stderr.on 'data', (data) ->
    process.stderr.write data.toString()
  coffee.stdout.on 'data', (data) ->
    print data.toString()
