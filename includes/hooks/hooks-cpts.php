<?php

add_action(
            'init',
            function()
            {
                \Vendi\A11Y\WordPress\CustomPostTypes\SiteAudit::register();
                \Vendi\A11Y\WordPress\CustomPostTypes\URL::register();
                \Vendi\A11Y\WordPress\CustomPostTypes\URLResult::register();
                \Vendi\A11Y\WordPress\CustomPostTypes\Rule::register();
            },
            0
        );
