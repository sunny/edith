decrypt = ->
  password = $('[data-encrypt-password]').val()
  encrypted = $('[data-encrypt-encrypted]').val()
  decrypted = sjcl.decrypt(password, encrypted)
  $('[data-encrypt-decrypted]').val(decrypted)
  $('[data-encrypt-decrypted]').trigger('change')

encrypt = ->
  password = $('[data-encrypt-password]').val()
  decrypted = $('[data-encrypt-decrypted]').val()
  encrypted = sjcl.encrypt(password, decrypted)
  $('[data-encrypt-encrypted]').val(encrypted)
  $('[data-encrypt-encrypted]').trigger('change')

$(document).ready decrypt
$(document).on 'change', '[data-encrypt-encrypted]', encrypt
