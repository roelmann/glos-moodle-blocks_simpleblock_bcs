<?php
class block_simpleblock_bcs extends block_base {
    public function init() {
        $this->title = get_string('blocktitle', 'block_simpleblock_bcs');
    }

    public function applicable_formats() {
        return array('my-index' => true);
    }

    public function instance_allow_multiple() {
        return false;
    }

    function has_config() {return true;}

    public function hide_header() {
        return false;
    }

    public function get_content() {
        if ($this->content !== null) {
        return $this->content;
        }

        global $COURSE, $DB, $PAGE;

        $this->content =  new stdClass;
        $this->content->text = '';
        $context = context_course::instance($COURSE->id);

        $this->content->header = get_string('blocktitle', 'block_simpleblock_bcs');
        if (has_capability('moodle/site:viewparticipants', $context)) {
            $img = new moodle_url('/blocks/simpleblock_bcs/pix/barcode_scanner.png');
            $link = new moodle_url('/local/barcode/submissions.php?id=399442&action=scanning');
            $this->content->text = '<div class="bcscontent" style="margin:auto; text-align:center;">';
            $this->content->text .= '<a href = "' . $link . '" alt = "Bar code scanning point">';
            $this->content->text .= '<img src = "' . $img . '" alt = "barcode scanner" style="margin:auto">';
            $this->content->text .= '<p>' . get_string('blockcontent', 'block_simpleblock_bcs') . '</p>';
            $this->content->text .= '</a>';
            $this->content->text .= '</div>';
        } else {
            $this->content->text = '';
        }
        $this->content->footer = '';
        return $this->content;
    }

}
?>