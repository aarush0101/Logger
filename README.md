# Logger Plugin

<div align="center">
  <img src="https://cdn.discordapp.com/attachments/1185749294943313930/1191312318840193136/3150836.png?ex=65a4fb0e&is=6592860e&hm=d55488287a6fffccc132d79582fbba572543269f098a9791030d3ffa2ec4a8eb" alt="Plugin Image" width="500">
</div>

## Description

This is a PocketMine-MP(PM-5) plugin that logs player joins, leaves, and chat messages to a Discord channel. Develop by two native developers.

## Features

- Logs player joins with a custom colored embed in Discord.
- Logs player leaves with a custom colored embed in Discord.
- Logs player chat messages with a custom colored embed in Discord.

## Installation

1. Download the ZIP file from Github and extract it.
2. In config.yml, change `webhook` to the webhook URL of the channel you want to send the logs to. Save the file.(You can also change the colors of the embeds but remember, those are in RGB format so don't put HEX or anything other.)
3. Stop your pocketmine server.
2. Copy the `Logger` directory (including `src`, `.poggit.yml`, `config.yml`, and `plugin.yml` files) to the `plugins` directory of your PocketMine server.
3. Start your PocketMine server.
4. Enjoy the plugin.

## Configuration

The plugin has basic configuration options that you can customize in the `config.yml` file. You can set your Discord webhook URL and adjust colors for different events.

## WARNING:
⚠️ Please do not change color codes if you don't know what you are doing/what a "0x" character means. If you still want to change color codes of the embeds, you can pick the RGB color code from appropriate websites and put it after "0x". Don't remove "0x". Like if you want to change this color code "0xFFFFFF", remove the "FFFFFF" RGB color code and put your color code. Like, we want green so we will put "0x046307".

```yaml
name: Logger
version: 2.0.9
main: Logger\Main
authors: [aarush_01, fresherGAMING]
api: 5.0.0
```