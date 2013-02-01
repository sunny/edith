require 'rack'
require 'rack-legacy'
require 'rack-rewrite'

use Rack::Rewrite do
  rewrite /.*/, lambda { |match, env|
    if File.exists?(File.join(Dir.getwd, env['PATH_INFO']))
      env['PATH_INFO']
    else
      env['RACK_REQUEST_URI'] = match[0]
      'index.php'
    end
  }
end

use Rack::Legacy::Php, Dir.getwd
use Rack::Legacy::Cgi, Dir.getwd
run Rack::File.new Dir.getwd
