#!/bin/bash
mkdir -p "$HOME/bin"
cd "$HOME/bin"
# Download a pre-compiled Linux version of FFmpeg
curl -L -o ffmpeg.tar.xz "https://johnvansickle.com/ffmpeg/releases/ffmpeg-release-amd64-static.tar.xz"
tar -xf ffmpeg.tar.xz
mv ffmpeg-*-static ffmpeg
# Make it executable
chmod +x ffmpeg/ffmpeg
chmod +x ffmpeg/ffprobe