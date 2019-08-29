UPLOAD=./upload $(1) $(2)
# when you change branch in main repo the timestamp of the file get update and the file get uploaded
# so we check md5 sum to not upload the file if it didn't change but only for files from main repo
CHECK_UPLOAD=md5sum -c $(1) > /dev/null 2>&1 || (./upload $(2) $(3); md5sum $(2) > $(1))
SIZE=ls -sh $(1) | cut -d' ' -f1
GZIP_SIZE=cp $(1) tmp && gzip tmp && ls -sh tmp.gz | cut -d' ' -f1 && rm tmp.gz

ALL: js/jquery.terminal.min.js css/jquery.terminal.min.css 400.php 401.php 403.php 404.php 500.php 

404.php: error.php
	sed -e 's/{{TITLE}}/Page Not Found/g' -e 's/{{CODE}}/404/' error.php > 404.php

500.php: error.php
	sed -e 's/{{TITLE}}/Internal Server Error/g' -e 's/{{CODE}}/500/' error.php > 500.php

400.php: error.php
	sed -e 's/{{TITLE}}/Bad Request/g' -e 's/{{CODE}}/400/' error.php > 400.php

401.php: error.php
	sed -e 's/{{TITLE}}/Unauthorized/g' -e 's/{{CODE}}/401/' error.php > 401.php

403.php: error.php
	sed -e 's/{{TITLE}}/Forbidden/g' -e 's/{{CODE}}/403/' error.php > 403.php

upload: .upload/service.php .upload/api_reference.php .upload/examples.php .upload/jquery.terminal-src.js .upload/jquery.terminal-src.css .upload/style.css .upload/index.php .upload/404.php .upload/403.php .upload/500.php .upload/terminal.error.js .upload/chat.js .upload/sysend.js .upload/favico.min.js

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

.upload/404.php: 404.php
	@$(call UPLOAD, 404.php,/)
	@touch .upload/404.php

.upload/403.php: 403.php
	@$(call UPLOAD, 403.php,/)
	@touch .upload/403.php

.upload/500.php: 500.php
	@$(call UPLOAD, 500.php,/)
	@touch .upload/500.php

.upload/chat.js: js/chat.js
	@$(call UPLOAD, js/chat.js,/js/)
	@touch .upload/chat.js

.upload/sysend.js: js/sysend.js
	@$(call UPLOAD, js/sysend.js,/js/)
	@touch .upload/sysend.js

.upload/favico.min.js: js/favico.min.js
	@$(call UPLOAD, js/favico.min.js,/js/)
	@touch .upload/favico.min.js
