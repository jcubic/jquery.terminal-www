VERSION=1.23.0
UPLOAD=./upload $(1) $(2)
# when you change branch in main repo the timestamp of the file get update and the file get uploaded
# so we check md5 sum to not upload the file if it didn't change but only for files from main repo
CHECK_UPLOAD=md5sum -c $(1) > /dev/null 2>&1 || (./upload $(2) $(3); md5sum $(2) > $(1))
SIZE=ls -sh $(1) | cut -d' ' -f1
GZIP_SIZE=cp $(1) tmp && gzip tmp && ls -sh tmp.gz | cut -d' ' -f1 && rm tmp.gz

ALL: index.php api_reference.php examples.php js/jquery.terminal.min.js css/jquery.terminal.min.css 404.shtml 403.shtml 500.shtml

index.php: ../.$(VERSION) index.php.in
	sed -e "s/{{VER}}/$(VERSION)/g" -e "s/{{JSMIN}}/`$(call SIZE, ../js/jquery.terminal-$(VERSION).min.js)`B/" -e "s/{{JSMIN_GZIP}}/`$(call GZIP_SIZE, ../js/jquery.terminal-$(VERSION).min.js)`B/" -e "s/{{JS}}/`$(call SIZE, ../js/jquery.terminal-$(VERSION).js)`B/" -e "s/{{JS_GZIP}}/`$(call GZIP_SIZE, ../js/jquery.terminal-$(VERSION).js)`B/" -e "s/{{CSSMIN}}/`$(call SIZE, ../css/jquery.terminal-$(VERSION).min.css)`B/" -e "s/{{CSSMIN_GZIP}}/`$(call GZIP_SIZE, ../css/jquery.terminal-$(VERSION).min.css)`B/" -e "s/{{CSS}}/`$(call SIZE, ../css/jquery.terminal-$(VERSION).css)`B/" -e "s/{{CSS_GZIP}}/`$(call GZIP_SIZE, ../css/jquery.terminal-$(VERSION).css)`B/" -e "s/{{UNIX}}/`$(call SIZE, ../js/unix_formatting.js)`B/" -e "s/{{UNIX_GZIP}}/`$(call GZIP_SIZE, ../js/unix_formatting.js)`B/" -e "s/{{LESS}}/`$(call SIZE, ../js/less.js)`B/" -e "s/{{LESS_GZIP}}/`$(call GZIP_SIZE, ../js/less.js)`B/" -e "s/{{PRISM}}/`$(call SIZE, ../js/prism.js)`B/" -e "s/{{PRISM_GZIP}}/`$(call GZIP_SIZE, ../js/prism.js)`B/" index.php.in > index.php

api_reference.php: ../.$(VERSION) api_reference.php.in
	sed -e "s/{{VER}}/$(VERSION)/g" api_reference.php.in > api_reference.php

examples.php: ../.$(VERSION) examples.php.in
	sed -e "s/{{VER}}/$(VERSION)/g" examples.php.in > examples.php

js/jquery.terminal.min.js: ../js/jquery.terminal.min.js
	cp ../js/jquery.terminal.min.js js/jquery.terminal.min.js

css/jquery.terminal.min.css: ../css/jquery.terminal.min.css
	cp ../css/jquery.terminal.min.css css/jquery.terminal.min.css

404.shtml: error.shtml
	sed -e 's/{{TITLE}}/Page Not Found/g' -e 's/{{CODE}}/404/' error.shtml > 404.shtml

500.shtml: error.shtml
	sed -e 's/{{TITLE}}/Internal Server Error/g' -e 's/{{CODE}}/500/' error.shtml > 500.shtml

403.shtml: error.shtml
	sed -e 's/{{TITLE}}/Forbidden/g' -e 's/{{CODE}}/403/' error.shtml > 403.shtml

upload: .upload/service.php .upload/api_reference.php .upload/examples.php .upload/jquery.terminal.min.js .upload/jquery.terminal-src.js .upload/jquery.terminal-src.css .upload/jquery.terminal.min.css .upload/style.css .upload/index.php .upload/unix_formatting.js .upload/404.shtml .upload/403.shtml .upload/500.shtml .upload/terminal.error.js .upload/chat.js .upload/sysend.js .upload/favico.min.js .upload/dterm.js

.upload/unix_formatting.js: ../js/unix_formatting.js
	@$(call CHECK_UPLOAD, .upload/unix_formatting.js,../js/unix_formatting.js,/js/)

.upload/service.php: service.php
	@$(call UPLOAD, service.php,/)
	@touch .upload/service.php

.upload/index.php: index.php
	@$(call UPLOAD, index.php,/)
	@touch .upload/index.php

.upload/jquery.terminal-src.js: ../js/jquery.terminal-src.js
	@$(call CHECK_UPLOAD, .upload/jquery.terminal-src.js, ../js/jquery.terminal-src.js,/js/)

.upload/jquery.terminal-src.css: ../css/jquery.terminal-src.css
	@$(call CHECK_UPLOAD, .upload/jquery.terminal-src.css,../css/jquery.terminal-src.css,/css/)

.upload/jquery.terminal.min.js: ../js/jquery.terminal.min.js
	@$(call CHECK_UPLOAD, .upload/jquery.terminal.min.js,../js/jquery.terminal.min.js,/js/)

.upload/jquery.terminal.min.css: ../css/jquery.terminal.min.css
	@$(call CHECK_UPLOAD, .upload/jquery.terminal.min.css, ../css/jquery.terminal.min.css,/css/)

.upload/style.css: css/style.css
	@$(call UPLOAD,css/style.css,/css/)
	@touch .upload/style.css

.upload/api_reference.php: api_reference.php
	@$(call UPLOAD, api_reference.php,/)
	@touch .upload/api_reference.php

.upload/examples.php: examples.php
	@$(call UPLOAD, examples.php,/)
	@touch .upload/examples.php

.upload/terminal.error.js: js/terminal.error.js
	@$(call UPLOAD, js/terminal.error.js,/js/)
	@touch .upload/terminal.error.js

.upload/404.shtml: 404.shtml
	@$(call UPLOAD, 404.shtml,/)
	@touch .upload/404.shtml

.upload/403.shtml: 403.shtml
	@$(call UPLOAD, 403.shtml,/)
	@touch .upload/403.shtml

.upload/500.shtml: 500.shtml
	@$(call UPLOAD, 500.shtml,/)
	@touch .upload/500.shtml

.upload/chat.js: js/chat.js
	@$(call UPLOAD, js/chat.js,/js/)
	@touch .upload/chat.js

.upload/dterm.js: js/dterm.js
	@$(call UPLOAD, js/dterm.js,/js/)
	@touch .upload/dterm.js

.upload/sysend.js: js/sysend.js
	@$(call UPLOAD, js/sysend.js,/js/)
	@touch .upload/sysend.js

.upload/favico.min.js: js/favico.min.js
	@$(call UPLOAD, js/favico.min.js,/js/)
	@touch .upload/favico.min.js
