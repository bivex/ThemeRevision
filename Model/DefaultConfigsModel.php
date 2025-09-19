<?php

namespace Kanboard\Plugin\ThemeRevision\Model;

class DefaultConfigsModel
{
    private $default_Configs_Schema = array(
        'version'                           => array('default' => '20230306v1'),

        // Development mode will introduce raw CSS files for easier customization and minify automatically after switching back. 
        // Make sure the "Asset" folder in plugin's root directory is WRITABLE and EXECUTABLE before switching !
        // 'production':    Load a minified CSS file. (default)
        // 'development':   Load all CSS files in the "Asset/dev" folder.
        'mode'                              => array('default' => 'development', 'candidates' => array('production', 'development')),

        // 'user':  Switch the color scheme by the users' choices. (default)
        // 'light': Always show the light scheme.
        // 'dark':  Always show the dark scheme.
        'color_scheme'                      => array('default' => 'user',       'candidates' => array('user', 'light', 'dark')),
        
        // Overwrite the default task color for better UI consistency. The option in project settings will be invalidated
        // 'true':  Overwrite to grey.  (default)
        // 'false': Keep system settings.
        'overwrite_default_task_color'      => array('default' => true,         'candidates' => array(true, false)),

        // 'true':  Replace Font Awesome with Google Material. (default)
        // 'false': Keep Font Awesome icons.
        'enable_google_material_icons'      => array('default' => true,         'candidates' => array(true, false)),

        // Override default fonts with "Google Fonts". Only one font family name supported by Google can be filled in for each category. Note: the font family name of a font may differ from it's general name.
        // If this feature is not working, please check the CSP settings on your server first. 
        // The default value for each category is empty.
        // 'ui':    A font name for Most parts of the system UI. Example: Noto Sans
        // 'codes': A font name for all code blocks, and statistics in the overview page. Monospaced fonts are recommended. Example: Noto Sans Mono
        'google_fonts' => array(
            'ui'                            => array('default' => ''),
            'codes'                         => array('default' => ''),
        ),

        // Display the statistics of a column if they exist. Hide all by default.
        'column_header_info' => array(
            'score'                         => array('default' => false,         'candidates' => array(true, false)),
            'column_description'            => array('default' => false,         'candidates' => array(true, false)),
            'tasks_number'                  => array('default' => false,         'candidates' => array(true, false)),
            'more_statistics'               => array('default' => false,         'candidates' => array(true, false)),
        ),
        
        // Display the information of a task if it exists. Show all by default.
        'board_task_info' => array(
            'category'                      => array('default' => true,         'candidates' => array(true, false)),
            'tags'                          => array('default' => true,         'candidates' => array(true, false)),
            'reference'                     => array('default' => true,         'candidates' => array(true, false)),
            'milestone'                     => array('default' => true,         'candidates' => array(true, false)),
            'score'                         => array('default' => true,         'candidates' => array(true, false)),
            'time_estimated'                => array('default' => true,         'candidates' => array(true, false)),
            'due_date'                      => array('default' => true,         'candidates' => array(true, false)),
            'recurrence_status'             => array('default' => true,         'candidates' => array(true, false)),
            'links_number'                  => array('default' => true,         'candidates' => array(true, false)),
            'subtasks_number'               => array('default' => true,         'candidates' => array(true, false)),
            'files_number'                  => array('default' => true,         'candidates' => array(true, false)),
            'comments_number'               => array('default' => true,         'candidates' => array(true, false)),
            'description'                   => array('default' => true,         'candidates' => array(true, false)),
            'task_age'                      => array('default' => true,         'candidates' => array(true, false)),
            'priority'                      => array('default' => true,         'candidates' => array(true, false)),
            'metaMagik'                     => array('default' => true,         'candidates' => array(true, false)),
            'metaMagik_metadata'            => array('default' => true,         'candidates' => array(true, false)),
        ),

        // The opacity of the above information.
        'task_footer_opacity' => array('default' => 0.08),

        // The corner radius for all elements.
        'corner_radius' => array('default' => '4px'),
        
        // Color Palettes
        // *-prim (primary):      button background, link, selected, alert foreground, helps or hints ...
        // *-secd (secondary):    hovered button foreground, linked comment ...
        // *-cont (contrast):     button foreground, alert background ...
        // grayscales-*:          colors for common UI elements, 1 (min) for foreground / text, 6 (max) for background
        // task-*-bg:             task background
        // task-*-bdr:            task border
        // code-*:                code syntax highlight
        // shadow-*:              shadow

        // Light Colors
        'light_palette' => array(
            // Messages & Actions
            'brand-prim'                    => array('default' => '#3B82F6'), // A modern, slightly muted blue
            'brand-cont'                    => array('default' => '#FFFFFF'), // White for contrast
            'brand-secd'                    => array('default' => '#BFDBFE'), // Lighter blue accent

            'info-prim'                     => array('default' => '#22D3EE'), // Calm light blue-green
            'info-cont'                     => array('default' => '#ECFEFF'),

            'reminder-prim'                 => array('default' => '#FACC15'), // Soft, warm yellow
            'reminder-cont'                 => array('default' => '#FFFBEB'),

            'warning-prim'                  => array('default' => '#EF4444'), // Muted red for warnings
            'warning-cont'                  => array('default' => '#FEF2F2'),
            'warning-secd'                  => array('default' => '#FCA5A5'),

            'success-prim'                  => array('default' => '#22C55E'), // Fresh green for success
            'success-cont'                  => array('default' => '#F0FDF4'),

            // Greyscales - modern, subtle range
            'greyscale-1'                   => array('default' => '#1F2937'), // Darkest grey for primary text
            'greyscale-2'                   => array('default' => '#4B5563'), // Medium-dark grey for secondary text/icons
            'greyscale-3'                   => array('default' => '#D1D5DB'), // Light grey for borders/dividers
            'greyscale-4'                   => array('default' => '#E5E7EB'), // Very light grey for subtle backgrounds
            'greyscale-5'                   => array('default' => '#F3F4F6'), // Even lighter grey for alternating sections
            'greyscale-6'                   => array('default' => '#FFFFFF'), // Pure white for main backgrounds

            // Tasks - soft and desaturated
            // Grey
            'task-grey-bg'                  => array('default' => '#F8F9FA'),
            'task-grey-bdr'                 => array('default' => '#E9ECEF'),
            'task-dark-grey-bg'             => array('default' => '#F1F3F5'),
            'task-dark-grey-bdr'            => array('default' => '#D8DDE4'),
            // Red
            'task-pink-bg'                  => array('default' => '#FEF2F2'),
            'task-pink-bdr'                 => array('default' => '#FCA5A5'),
            'task-red-bg'                   => array('default' => '#FEF2F2'),
            'task-red-bdr'                  => array('default' => '#FCA5A5'),
            // Orange
            'task-orange-bg'                => array('default' => '#FFFBEB'),
            'task-orange-bdr'               => array('default' => '#FDE68A'),
            'task-deep-orange-bg'           => array('default' => '#FFEDD5'),
            'task-deep-orange-bdr'          => array('default' => '#FDBA74'),
            // Yellow
            'task-yellow-bg'                => array('default' => '#FFFBEB'),
            'task-yellow-bdr'               => array('default' => '#FDE68A'),
            'task-amber-bg'                 => array('default' => '#FEF3C7'),
            'task-amber-bdr'                => array('default' => '#FCD34D'),
            'task-brown-bg'                 => array('default' => '#F3F4F6'),
            'task-brown-bdr'                => array('default' => '#E5E7EB'),
            // Lime
            'task-lime-bg'                  => array('default' => '#F7FEE7'),
            'task-lime-bdr'                 => array('default' => '#D9F99D'),
            // Green
            'task-light-green-bg'           => array('default' => '#F0FDF4'),
            'task-light-green-bdr'          => array('default' => '#A7F3D0'),
            'task-green-bg'                 => array('default' => '#F0FDF4'),
            'task-green-bdr'                => array('default' => '#A7F3D0'),
            // Cyan
            'task-cyan-bg'                  => array('default' => '#F0FCFD'),
            'task-cyan-bdr'                 => array('default' => '#99F6E4'),
            'task-teal-bg'                  => array('default' => '#F0FCFD'),
            'task-teal-bdr'                 => array('default' => '#99F6E4'),
            // Blue
            'task-blue-bg'                  => array('default' => '#EFF6FF'),
            'task-blue-bdr'                 => array('default' => '#BFDBFE'),
            // Purple
            'task-purple-bg'                => array('default' => '#F5F3FF'),
            'task-purple-bdr'               => array('default' => '#DDA0DD'),

            // Code Highlight - kept original for now as they are syntax-specific
            'code-a'                        => array('default' => '#c56200'),
            'code-b'                        => array('default' => '#d92792'),
            'code-c'                        => array('default' => '#cc5e91'),
            'code-d'                        => array('default' => '#3787c7'),
            'code-e'                        => array('default' => '#0d7d6c'),
            'code-f'                        => array('default' => '#7641bb'),

            // shadow - adjusted slightly for softer appearance
            'shadow-lit'                    => array('default' => 'rgba(0, 0, 0, .05)'),
            'shadow-hev'                    => array('default' => 'rgba(0, 0, 0, .12)')
        ),
        'dark_palette' => array(
            // Messages & Actions
            'brand-prim'                    => array('default' => '#60A5FA'), // Brighter blue for contrast
            'brand-cont'                    => array('default' => '#E0E7FF'), // Light, readable text
            'brand-secd'                    => array('default' => '#1E3A8A'), // Deep blue accent

            'info-prim'                     => array('default' => '#20C997'), // Deep teal for info
            'info-cont'                     => array('default' => '#E6FFFA'),

            'reminder-prim'                 => array('default' => '#F0B90B'), // Rich golden yellow
            'reminder-cont'                 => array('default' => '#FFFBEB'),

            'warning-prim'                  => array('default' => '#DC3545'), // Deep, clear red for warnings
            'warning-cont'                  => array('default' => '#FFF0F0'),
            'warning-secd'                  => array('default' => '#A7202B'),

            'success-prim'                  => array('default' => '#28A745'), // Classic deep green for success
            'success-cont'                  => array('default' => '#EAFBEF'),

            // Greyscales - deep and rich for dark mode
            'greyscale-1'                   => array('default' => '#F8F9FA'), // Lightest for text/foreground
            'greyscale-2'                   => array('default' => '#ADB5BD'), // Medium grey for secondary text/icons
            'greyscale-3'                   => array('default' => '#495057'), // Darker grey for borders/dividers
            'greyscale-4'                   => array('default' => '#343A40'), // Deep grey for subtle backgrounds
            'greyscale-5'                   => array('default' => '#212529'), // Darker background segments
            'greyscale-6'                   => array('default' => '#0F1116'), // Deepest background

            // Tasks - rich and subdued
            // Grey
            'task-grey-bg'                  => array('default' => '#212529'),
            'task-grey-bdr'                 => array('default' => '#495057'),
            'task-dark-grey-bg'             => array('default' => '#1A1D20'),
            'task-dark-grey-bdr'            => array('default' => '#3B424B'),
            // Red
            'task-pink-bg'                  => array('default' => '#491A1A'),
            'task-pink-bdr'                 => array('default' => '#8E2F2F'),
            'task-red-bg'                   => array('default' => '#491A1A'),
            'task-red-bdr'                  => array('default' => '#8E2F2F'),
            // Orange
            'task-orange-bg'                => array('default' => '#4C2E00'),
            'task-orange-bdr'               => array('default' => '#8A5A00'),
            'task-deep-orange-bg'           => array('default' => '#552600'),
            'task-deep-orange-bdr'          => array('default' => '#A04F00'),
            // Yellow
            'task-yellow-bg'                => array('default' => '#4C2E00'),
            'task-yellow-bdr'               => array('default' => '#8A5A00'),
            'task-amber-bg'                 => array('default' => '#533B00'),
            'task-amber-bdr'                => array('default' => '#9E7B00'),
            'task-brown-bg'                 => array('default' => '#3B322D'),
            'task-brown-bdr'                => array('default' => '#665345'),
            // Lime
            'task-lime-bg'                  => array('default' => '#2F3B1A'),
            'task-lime-bdr'                 => array('default' => '#5C7433'),
            // Green
            'task-light-green-bg'           => array('default' => '#224125'),
            'task-light-green-bdr'          => array('default' => '#3A7543'),
            'task-green-bg'                 => array('default' => '#224125'),
            'task-green-bdr'                => array('default' => '#3A7543'),
            // Cyan
            'task-cyan-bg'                  => array('default' => '#1B3C3F'),
            'task-cyan-bdr'                 => array('default' => '#277F83'),
            'task-teal-bg'                  => array('default' => '#1E403D'),
            'task-teal-bdr'                 => array('default' => '#2D8A82'),
            // Blue
            'task-blue-bg'                  => array('default' => '#1A2D4F'),
            'task-blue-bdr'                 => array('default' => '#2B6CB0'),
            // Purple
            'task-purple-bg'                => array('default' => '#2C1A4A'),
            'task-purple-bdr'               => array('default' => '#581C87'),

            // Code Highlight - kept original for consistency or specific needs
            'code-a'                        => array('default' => '#c56200'),
            'code-b'                        => array('default' => '#d92792'),
            'code-c'                        => array('default' => '#cc5e91'),
            'code-d'                        => array('default' => '#3787c7'),
            'code-e'                        => array('default' => '#0d7d6c'),
            'code-f'                        => array('default' => '#7641bb'),

            // shadow - adjusted for deeper shadows on dark background
            'shadow-lit'                    => array('default' => 'rgba(0, 0, 0, .45)'),
            'shadow-hev'                    => array('default' => 'rgba(0, 0, 0, .7)')
        )
    );

    public function checkDiffColor($paletteName, $oldConfigs){
        $diffs = array();

        if (isset($oldConfigs[$paletteName])){
            foreach ($this->default_Configs_Schema[$paletteName] as $key => $raw){
                if (!isset($oldConfigs[$paletteName][$key])){
                    $diffs[$key] = array(
                        'old' => '',
                        'new' => $this->getConfig($raw)
                    );
                }
                else if ($this->getConfig($raw) != $oldConfigs[$paletteName][$key]){
                    $diffs[$key] = array(
                        'old' => $oldConfigs[$paletteName][$key],
                        'new' => $this->getConfig($raw)
                    );
                }
            }
        }
        
        return $diffs;
    }

    public function getDefaultConfigs(){
        $configs = array();

        foreach ($this->default_Configs_Schema as $key => $raw){
            if (is_array($raw) && isset($raw['default'])){
                $configs[$key] = $raw['default'];
            }
            else if(is_array($raw)){
                $configs[$key] = array();

                foreach($raw as $subKey => $subRaw){
                    if (is_array($subRaw) && isset($subRaw['default'])){
                        $configs[$key][$subKey] = $subRaw['default'];
                    }
                }
            }
        }
        return $configs;
    }

    public function getVersion(){
        return $this->getConfig($this->default_Configs_Schema['version']);
    }

    public function getCandidates($key){
        return $this->default_Configs_Schema[$key]["candidates"];
    }

    private function getConfig($raw){
        return $raw['default'];
    }
}
