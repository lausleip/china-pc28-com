<?php
/**
 * 站点元信息管理 - 用于生成简短描述文本
 * 
 * 本模块将站点基础信息以数组方式统一管理，
 * 并提供根据当前上下文生成描述文本的方法。
 */

// 站点元数据配置
$siteMeta = [
    'site_name'        => '中国PC28 - 加拿大28数据参考',
    'site_url'         => 'https://china-pc28.com',
    'keywords'         => ['加拿大28', 'PC28预测', '开奖结果', '走势分析'],
    'description'      => '提供加拿大28开奖数据、走势图表与预测参考，助力理性分析。',
    'author'           => 'China PC28 Team',
    'language'         => 'zh-CN',
    'charset'          => 'UTF-8',
    'version'          => '2.0.1',
    'last_updated'     => '2025-03-21',
    'contact_email'    => 'support@china-pc28.com',
    'short_desc_limit' => 120,
];

/**
 * 生成简短的站点描述文本 (限制长度)
 *
 * @param array  $meta   站点元数据数组
 * @param int    $maxLen 最大字符数，默认120
 * @return string 裁剪后的描述，若超出则末尾添加省略号
 */
function generateShortDescription(array $meta, int $maxLen = 120): string
{
    $desc = $meta['description'] ?? '';
    
    // 补充关键词信息
    if (!empty($meta['keywords'])) {
        $kwStr = implode('、', $meta['keywords']);
        $desc .= ' 核心关键词：' . $kwStr;
    }

    // 截断处理
    if (mb_strlen($desc) > $maxLen) {
        $desc = mb_substr($desc, 0, $maxLen - 3) . '...';
    }

    return $desc;
}

/**
 * 生成SEO友好的元信息字符串 (用于 <meta> 标签)
 *
 * @param array $meta
 * @return string 组合后的元数据字符串
 */
function generateMetaString(array $meta): string
{
    $parts = [];
    $parts[] = $meta['site_name'];
    $parts[] = $meta['site_url'];
    $parts[] = implode(', ', $meta['keywords']);
    $parts[] = $meta['description'];
    return implode(' | ', $parts);
}

/**
 * 获取完整的元数据数组（可用于 API 输出）
 *
 * @param array $meta
 * @return array
 */
function getFullMeta(array $meta): array
{
    return [
        'title'       => $meta['site_name'],
        'url'         => $meta['site_url'],
        'keywords'    => $meta['keywords'],
        'description' => generateShortDescription($meta, 160),
        'author'      => $meta['author'],
        'language'    => $meta['language'],
        'charset'     => $meta['charset'],
        'version'     => $meta['version'],
        'updated'     => $meta['last_updated'],
    ];
}

// ---------- 示例输出 ----------

echo "=== 简短描述 ===\n";
echo generateShortDescription($siteMeta) . "\n\n";

echo "=== 元信息字符串 ===\n";
echo generateMetaString($siteMeta) . "\n\n";

echo "=== 完整元数据 (JSON) ===\n";
echo json_encode(getFullMeta($siteMeta), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";