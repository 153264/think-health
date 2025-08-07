import { defineConfig } from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
  title: "think-health",
  description: "一个为 ThinkPHP 框架设计的健康检查库",
  base: '/think-health/',
  lastUpdated: true,
  themeConfig: {
    // https://vitepress.dev/reference/default-theme-config
    search: {
      provider: 'local'
    },

    footer: {
      message: 'Released under the <a href="https://github.com/153264/think-health/blob/main/LICENSE">MIT License</a>.',
      copyright: 'Copyright © 2025-present <a href="https://github.com/153264">153264</a>'
    },

    nav: [
      { text: '首页', link: '/' },
      { text: '文档', link: '/usage/' }
    ],

    sidebar: [
      {
        text: '开始使用',
        items: [
          { text: '立即开始', link: '/usage/' },
          { text: '配置', link: '/usage/config' },
          { text: '参与贡献', link: '/contributing' },
          { text: '常见问题', link: '/troubleshooting' },
        ]
      },
      {
        text: '扩展',
        items: [
          { text: '自定义检查器', link: '/check/' },
          { text: '自定义上报器', link: '/report/' },
        ]
      },
      {
        text: '内置检查器',
        items: [
          { text: '数据库检查器', link: '/check/database' },
          { text: '缓存检查器', link: '/check/cache' },
          { text: '环境变量检查器', link: '/check/env' },
          { text: '文件夹大小检查器', link: '/check/folder' },
          { text: 'HTTP资源检查器', link: '/check/http' },
        ]
      },
      {
        text: '内置上报器',
        items: [
          { text: 'HTTP网络上报器', link: '/report/http' },
        ]
      }
    ],

    socialLinks: [
      { icon: 'github', link: 'https://github.com/153264/think-health' }
    ]
  }
})
