---
outline: deep
---

# health:check 健康检查

## 使用示例

```bash
php think health:check [--report] [--format] [--error]
```

## 参数说明

| 参数   | 短参数 | 是否必传 | 默认值 | 说明           |
| ------ | ------ | -------- | ------ | -------------- |
| report | r      | 否       | -      | 是否上报       |
| error  | e      | 否       | -      | 是否只输出异常 |
| format | f      | 否       | table  | 输出格式       |

### 输出格式

| 参数   | 短参数   |
| ------ | -------- |
| table  | 表格输出 |
| line   | 行输出   |
| simple | 简洁输出 |

## 示例

### 默认格式

```bash
php think health:check

+--------------------------------------------+--------------------------------------------------------------------------------------------+
| Name                                       | Message                                                                                    |
+--------------------------------------------+--------------------------------------------------------------------------------------------+
| CheckDataBase                              | SQLSTATE[HY000] [1045] Access denied for user 'username'@'localhost' (using password: YES) |
| CheckCache                                 | ok                                                                                         |
| CheckEnv                                   | APP_DEBUG is not falsy                                                                     |
| CheckFolder                                | ok                                                                                         |
| CheckHttp https://your-server.com/resource | request failed with status code: 0                                                         |
+--------------------------------------------+--------------------------------------------------------------------------------------------+
```

### 只输出异常

```bash
php think health:check --error

+--------------------------------------------+--------------------------------------------------------------------------------------------+
| Name                                       | Message                                                                                    |
+--------------------------------------------+--------------------------------------------------------------------------------------------+
| CheckDataBase                              | SQLSTATE[HY000] [1045] Access denied for user 'username'@'localhost' (using password: YES) |
| CheckEnv                                   | APP_DEBUG is not falsy                                                                     |
| CheckHttp https://your-server.com/resource | request failed with status code: 0                                                         |
+--------------------------------------------+--------------------------------------------------------------------------------------------+
```

### 简洁格式

```bash
php think health:check --format simple

# 正常
ok
# 异常
error
```

### 表格格式输出

```bash
php think health:check --format table

+--------------------------------------------+--------------------------------------------------------------------------------------------+
| Name                                       | Message                                                                                    |
+--------------------------------------------+--------------------------------------------------------------------------------------------+
| CheckDataBase                              | SQLSTATE[HY000] [1045] Access denied for user 'username'@'localhost' (using password: YES) |
| CheckCache                                 | ok                                                                                         |
| CheckEnv                                   | APP_DEBUG is not falsy                                                                     |
| CheckFolder                                | ok                                                                                         |
| CheckHttp https://your-server.com/resource | request failed with status code: 0                                                         |
+--------------------------------------------+--------------------------------------------------------------------------------------------+
```

### 表格格式只输出异常

```bash
php think health:check --format table --error

+--------------------------------------------+--------------------------------------------------------------------------------------------+
| Name                                       | Message                                                                                    |
+--------------------------------------------+--------------------------------------------------------------------------------------------+
| CheckDataBase                              | SQLSTATE[HY000] [1045] Access denied for user 'username'@'localhost' (using password: YES) |
| CheckEnv                                   | APP_DEBUG is not falsy                                                                     |
| CheckHttp https://your-server.com/resource | request failed with status code: 0                                                         |
+--------------------------------------------+--------------------------------------------------------------------------------------------+
```

### 行格式输出

```bash
php think health:check --format table

CheckDataBase SQLSTATE[HY000] [1045] Access denied for user 'username'@'localhost' (using password: YES)
CheckCache ok
CheckEnv APP_DEBUG is not falsy
CheckFolder ok
CheckHttp https://your-server.com/resource request failed with status code: 0
```

### 行格式只输出异常

```bash
php think health:check --format table --error

CheckDataBase SQLSTATE[HY000] [1045] Access denied for user 'username'@'localhost' (using password: YES)
CheckEnv APP_DEBUG is not falsy
CheckHttp https://your-server.com/resource request failed with status code: 0
```
