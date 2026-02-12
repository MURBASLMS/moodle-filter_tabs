<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace filter_tabs\output;

use filter_tabs\tab;

/**
 * Renderer for filter tabs.
 *
 * @package    filter_tabs
 * @copyright  2022 José Puente <jpuentefs@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends \plugin_renderer_base {

    /**
     * This was implemented with a random number previously, but was changed to a static counter for performance reasons.
     *
     * @var integer Counter for tabgroups
     */
    private static $tabgroupcounter = 0;

    /**
     * Creates tabs.
     *
     * @param renderable $renderable
     * @return string
     */
    public function render_renderable(renderable $renderable) {
        self::increase_group_counter();
        return $this->render_from_template($renderable->get_template(), $renderable->export_for_template($this));
    }

    /**
     * Renders for mobile.
     *
     * @param tab[] $tabs
     * @return string
     */
    public function render_for_mobile(array $tabs) {
        $context = [
            'initialvalue' => 'filter-tab-' . $tabs[0]->get_key(),
            'tabs' => array_values(array_map(function(tab $tab) {
                return [
                    'value' => 'filter-tab-' . $tab->get_key(),
                    'title' => $tab->get_title(),
                    'content' => $tab->get_content(),
                ];
            }, $tabs)),
        ];
        return $this->render_from_template('filter_tabs/mobile', $context);
    }

    /**
     * Get group counter id.
     */
    public static function get_group_counter() {
        return self::$tabgroupcounter;
    }

    /**
     * Increases group counter id.
     */
    public static function increase_group_counter() {
        self::$tabgroupcounter++;
    }
}
