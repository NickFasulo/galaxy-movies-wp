/* No build step: plain ES5 against the wp.* globals enqueued via block.json. */
(function (wp) {
  var el = wp.element.createElement;
  var Fragment = wp.element.Fragment;
  var __ = wp.i18n.__;
  var InspectorControls = wp.blockEditor.InspectorControls;
  var PanelBody = wp.components.PanelBody;
  var SelectControl = wp.components.SelectControl;
  var RangeControl = wp.components.RangeControl;
  var ServerSideRender = wp.serverSideRender;

  var PROVIDERS = [
    { value: 'netflix', label: 'Netflix' },
    { value: 'amazon-prime-video', label: 'Amazon Prime Video' },
    { value: 'hulu', label: 'Hulu' },
    { value: 'disney-plus', label: 'Disney+' },
    { value: 'apple-tv', label: 'Apple TV' },
    { value: 'max', label: 'HBO Max' },
    { value: 'peacock', label: 'Peacock' },
    { value: 'paramount-plus', label: 'Paramount+' },
    { value: 'tubi', label: 'Tubi' },
    { value: 'pluto-tv', label: 'Pluto TV' },
    { value: 'roku-channel', label: 'The Roku Channel' },
    { value: 'starz', label: 'Starz' },
    { value: 'amc-plus', label: 'AMC+' },
    { value: 'mgm-plus', label: 'MGM+' },
    { value: 'crunchyroll', label: 'Crunchyroll' },
    { value: 'discovery-plus', label: 'Discovery+' },
    { value: 'plex', label: 'Plex' },
    { value: 'kanopy', label: 'Kanopy' },
    { value: 'shudder', label: 'Shudder' },
    { value: 'criterion', label: 'Criterion Channel' },
  ];

  wp.blocks.registerBlockType('galaxy-movies/embed', {
    edit: function (props) {
      var attrs = props.attributes;
      var set = function (patch) {
        return props.setAttributes(patch);
      };
      return el(
        Fragment,
        {},
        el(
          InspectorControls,
          {},
          el(
            PanelBody,
            { title: __('Galaxy Movies widget', 'galaxy-movies-embeds') },
            el(SelectControl, {
              label: __('Widget type', 'galaxy-movies-embeds'),
              value: attrs.kind,
              options: [
                { value: 'changes', label: __('New & leaving (per service)', 'galaxy-movies-embeds') },
                { value: 'churn', label: __('Monthly churn card', 'galaxy-movies-embeds') },
              ],
              onChange: function (v) {
                set({ kind: v });
              },
            }),
            attrs.kind === 'changes' &&
              el(SelectControl, {
                label: __('Service', 'galaxy-movies-embeds'),
                value: attrs.provider,
                options: PROVIDERS,
                onChange: function (v) {
                  set({ provider: v });
                },
              }),
            el(SelectControl, {
              label: __('Theme', 'galaxy-movies-embeds'),
              value: attrs.theme,
              options: [
                { value: 'dark', label: __('Dark', 'galaxy-movies-embeds') },
                { value: 'light', label: __('Light', 'galaxy-movies-embeds') },
              ],
              onChange: function (v) {
                set({ theme: v });
              },
            }),
            el(RangeControl, {
              label: __('Height (px)', 'galaxy-movies-embeds'),
              value: attrs.height,
              min: 200,
              max: 900,
              onChange: function (v) {
                set({ height: v });
              },
            })
          )
        ),
        el(ServerSideRender, { block: 'galaxy-movies/embed', attributes: attrs })
      );
    },
  });
})(window.wp);
